<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Service;

use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Player;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\PlayerInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\RosterAssignment;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\RosterAssignmentInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Team;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\TeamInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Repository\PlayerRepository;
use HansPeterOrding\NflFastrSymfonyBundle\Repository\RosterAssignmentRepository;
use HansPeterOrding\NflFastrSymfonyBundle\Repository\TeamRepository;
use Iterator;
use League\Csv\Reader;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class ImportService
{
	public const NOT_AVAILABLE = 'NA';

	private const DEFAULT_DELIMITER = ',';
	private const DEFAULT_ENCLOSURE = '"';

	private const ROSTER_FILE_PREFIX = 'roster_';
	private const ROSTER_FILE_SUFFIX = '';

	private static array $birthDateSourceFormats = [
		'Y-m-d',
		'm/d/Y'
	];

	private static array $heightParsingPatterns = [
		'#^(?<feet>\d+)\'(?<inches>\d+)"$#',
		'#^(?<feet>\d+)-(?<inches>\d+)$#'
	];

	private iterable $sources;

	private TeamRepository $teamRepository;

	private PlayerRepository $playerRepository;

	private RosterAssignmentRepository $rosterAssignmentRepository;

	private EntityManagerInterface $entityManager;

	private InputInterface $input;

	private OutputInterface $output;

	private int $foundRows = 0;

	private ?ProgressBar $progressBar = null;

	public function __construct(
		array $sources,
		TeamRepository $teamRepository,
		PlayerRepository $playerRepository,
		RosterAssignmentRepository $rosterAssignmentRepository,
		EntityManagerInterface $entityManager
	) {
		$this->sources = $sources;
		$this->teamRepository = $teamRepository;
		$this->playerRepository = $playerRepository;
		$this->rosterAssignmentRepository = $rosterAssignmentRepository;
		$this->entityManager = $entityManager;
	}

	public function setOutput(OutputInterface $output): self
	{
		$this->output = $output;

		return $this;
	}

	public function setInput(InputInterface $input): self
	{
		$this->input = $input;

		return $this;
	}

	public function importRosterSeason(int $season, bool $interactive = false)
	{
		$this->output->writeln(sprintf('<info>Starting import of season %s</info>', $season));

		$csvUrl = $this->sources['roster']['baseUrl'] . $this->sources['roster']['path'] . static::ROSTER_FILE_PREFIX . $season . self::ROSTER_FILE_SUFFIX . '.csv';

		$records = $this->readCsv($csvUrl);

		if ($season === (int)(new DateTime())->format('Y')) {
			$this->output->writeln('<info>Set all teams to inactive</info>');
			$this->deactivateAllTeams();
		}

		$this->initProgressBar($this->foundRows);

		foreach ($records as $record) {
			$this->progressBar->setMessage(sprintf(
				'Importing %s for Team %s',
				$record[PlayerInterface::COLUMN_PLAYER_FULLNAME],
				$record[TeamInterface::COLUMN_TEAM_ABBREVIATION]
			));

			$team = $this->handleTeam($record[TeamInterface::COLUMN_TEAM_ABBREVIATION], $season, $interactive);
			$player = $this->handlePlayer($record);
			$this->handleRosterAssignment($season, $record, $team, $player);

			$this->progressBar->advance();
		}

		$this->progressBar->setMessage(sprintf(
			'Import for season %s finished.', $season
		));
		$this->progressBar->finish();

		$this->entityManager->clear();
	}

	private function readCsv($url): Iterator
	{
		$content = file_get_contents($url);

		$reader = Reader::createFromString($content);
		$reader->setDelimiter(static::DEFAULT_DELIMITER);
		$reader->setEnclosure(static::DEFAULT_ENCLOSURE);
		$reader->setHeaderOffset(0);

		$this->foundRows = $reader->count();

		return $reader->getRecords();
	}

	private function deactivateAllTeams()
	{
		$this->teamRepository->deactivateAll();
	}

	private function handleTeam(string $abbreviation, int $season, bool $interactive = false): Team
	{
		$team = $this->teamRepository->findTeamByAbbreviation($abbreviation);
		if (!$team) {
			$team = new Team();
			$team->setStatus(TeamInterface::STATUS_INACTIVE);
		}

		$team->setAbbreviation($abbreviation);

		$teamName = constant("HansPeterOrding\NflFastrSymfonyBundle\Entity\TeamInterface::TEAM_TITLE_" . $abbreviation);
		if ($teamName === null || $interactive) {
			if ($teamName === null) {
				$this->output->writeln(sprintf('<error>No default team title found for %s</error>', $abbreviation));
			}
			$teamName = $this->requestTeamName($abbreviation);
		}
		$team->setName($teamName);
		if ($season === (int)(new DateTime())->format('Y')) {
			$team->setStatus(TeamInterface::STATUS_ACTIVE);
		}

		$this->teamRepository->persistTeam($team);

		return $team;
	}

	private function handlePlayer(array $record): Player
	{
		$player = $this->playerRepository->findUniquePlayer($record);

		if (!$player) {
			$player = new Player();
		}

		$player->setFirstName($record[PlayerInterface::COLUMN_PLAYER_FIRSTNAME]);
		$player->setLastName($record[PlayerInterface::COLUMN_PLAYER_LASTNAME]);
		$player->setBirthDate($this->buildBirthDate($record[PlayerInterface::COLUMN_PLAYER_BIRTHDATE]));

		$player->setHeight(
			$this->buildHeight($record[PlayerInterface::COLUMN_PLAYER_HEIGHT])
		);
		$player->setWeight(
			$this->buildWeight($record[PlayerInterface::COLUMN_PLAYER_WEIGHT])
		);
		$player->setCollege($record[PlayerInterface::COLUMN_PLAYER_COLLEGE]);
		$player->setHighSchool($record[PlayerInterface::COLUMN_PLAYER_HIGHSCHOOL]);

		if ($record[PlayerInterface::COLUMN_PLAYER_GSIS_ID] !== static::NOT_AVAILABLE) {
			$player->setGsisId($record[PlayerInterface::COLUMN_PLAYER_GSIS_ID]);
		}
		if ($record[PlayerInterface::COLUMN_PLAYER_ESPN_ID] !== static::NOT_AVAILABLE) {
			$player->setEspnId($record[PlayerInterface::COLUMN_PLAYER_ESPN_ID]);
		}
		if ($record[PlayerInterface::COLUMN_PLAYER_SPORTRADAR_ID] !== static::NOT_AVAILABLE) {
			$player->setSportradarId($record[PlayerInterface::COLUMN_PLAYER_SPORTRADAR_ID]);
		}
		if ($record[PlayerInterface::COLUMN_PLAYER_YAHOO_ID] !== static::NOT_AVAILABLE) {
			$player->setYahooId($record[PlayerInterface::COLUMN_PLAYER_YAHOO_ID]);
		}
		if ($record[PlayerInterface::COLUMN_PLAYER_ROTOWIRE_ID] !== static::NOT_AVAILABLE) {
			$player->setRotowireId($record[PlayerInterface::COLUMN_PLAYER_ROTOWIRE_ID]);
		}

		$player->setHeadshotUrl($record[PlayerInterface::COLUMN_PLAYER_HEADSHOT_URL]);

		$this->playerRepository->persistPlayer($player);

		return $player;
	}

	private function handleRosterAssignment(int $season, array $record, Team $team, Player $player): RosterAssignment
	{
		$rosterAssignment = $this->rosterAssignmentRepository->findCurrentRosterAssignment($season, $player);

		if (!$rosterAssignment) {
			$rosterAssignment = new RosterAssignment();
		}

		$rosterAssignment->setTeam($team);
		$rosterAssignment->setPlayer($player);
		$rosterAssignment->setSeason($season);

		$rosterAssignment->setPosition($record[RosterAssignmentInterface::COLUMN_ROSTERASSIGNMENT_POSITION]);
		$rosterAssignment->setDepthChartPosition($record[RosterAssignmentInterface::COLUMN_ROSTERASSIGNMENT_DEPTH_CHART_POSITION]);
		$rosterAssignment->setJerseyNumber((int)$record[RosterAssignmentInterface::COLUMN_ROSTERASSIGNMENT_JERSEY_NUMBER]);
		$rosterAssignment->setStatus(
			RosterAssignment::$statusMappings[$record[RosterAssignmentInterface::COLUMN_ROSTERASSIGNMENT_STATUS]]
		);

		$this->rosterAssignmentRepository->persistRosterAssignment($rosterAssignment);

		return $rosterAssignment;
	}

	private function buildBirthDate(string $birthDateString): ?DateTimeImmutable
	{
		if ($birthDateString === static::NOT_AVAILABLE) {
			return null;
		}

		foreach (static::$birthDateSourceFormats as $birthDateSourceFormat) {
			$birthDate = DateTimeImmutable::createFromFormat($birthDateSourceFormat, $birthDateString);
			if ($birthDate) {
				return $birthDate;
			}
		}

		return null;
	}

	private function buildHeight(string $heightString): ?Player\Height
	{
		$result = null;

		if ($heightString === static::NOT_AVAILABLE) {
			return null;
		}

		foreach (static::$heightParsingPatterns as $heightParsingPattern) {
			preg_match($heightParsingPattern, $heightString, $result);
			if (array_key_exists('feet', $result) || array_key_exists('inches', $result)) {
				break;
			}
		}

		$height = new Player\Height();
		$height->setFeet((int)$result['feet']);
		$height->setInches((int)$result['inches']);
		$height->setCm($height->calculateCm());

		return $height;
	}

	private function buildWeight(string $weightString): Player\Weight
	{
		$weight = new Player\Weight();

		$weight->setPounds((int)$weightString);
		$weight->setKilograms($weight->calculateKilograms());

		return $weight;
	}

	private function requestTeamName(string $abbreviation): string
	{
		$nameQuestion = new Question('Bitte geben Sie einen Namen für das Team "' . $abbreviation . '" ein: ');
		$helper = new QuestionHelper();

		return $helper->ask($this->input, $this->output, $nameQuestion);
	}

	private function initProgressBar(int $max)
	{
		ProgressBar::setFormatDefinition('custom',
			"%bar% %current%/%max% (%percent%)\nElapsed time: %elapsed:-80s%\nRemaining time: %remaining:-80s%\nEstimated time: %estimated:-80s%\nMemory used: %memory:-80s% \n%message:-80s%\n\n");
		$this->progressBar = new ProgressBar($this->output, $max);
		$this->progressBar->setFormat('custom');
		$this->progressBar->setBarCharacter('<fg=green>⚬</>');
		$this->progressBar->setEmptyBarCharacter("<fg=red>⚬</>");
		$this->progressBar->setProgressCharacter("<fg=green>➤</>");

		$this->progressBar->setRedrawFrequency(1);

		$this->progressBar->setMessage('');
		$this->progressBar->start();
	}
}
