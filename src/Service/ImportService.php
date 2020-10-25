<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Service;

use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use HansPeterOrding\NflFastrSymfonyBundle\CsvConverter\PlayerConverterInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Player;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\PlayerInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\RosterAssignment;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\RosterAssignmentInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Team;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\TeamInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Repository\PlayerRepository;
use HansPeterOrding\NflFastrSymfonyBundle\Repository\RosterAssignmentRepository;
use HansPeterOrding\NflFastrSymfonyBundle\Repository\TeamRepository;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class ImportService
{
	private ResourceHandlerService $resourceHandlerService;

	private PlayerConverterInterface $playerConverter;

	private TeamRepository $teamRepository;

	private PlayerRepository $playerRepository;

	private RosterAssignmentRepository $rosterAssignmentRepository;

	private EntityManagerInterface $entityManager;

	private InputInterface $input;

	private OutputInterface $output;

	private int $foundRows = 0;

	private ?ProgressBar $progressBar = null;

	public function __construct(
		ResourceHandlerService $resourceHandlerService,
		EntityManagerInterface $entityManager,
		PlayerConverterInterface $playerConverter,

		TeamRepository $teamRepository,
		RosterAssignmentRepository $rosterAssignmentRepository

	) {
		$this->resourceHandlerService = $resourceHandlerService;
		$this->entityManager = $entityManager;
		$this->playerConverter = $playerConverter;


		$this->teamRepository = $teamRepository;
		$this->rosterAssignmentRepository = $rosterAssignmentRepository;
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

		$fileInfo = $this->resourceHandlerService->buildRosterFileInfo($season);
		$records = $this->resourceHandlerService->readCsvFromUrl($fileInfo);

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

	public function importPlayByPlaySeason(int $season)
	{
		$this->output->writeln(sprintf('<info>Starting import of season %s</info>', $season));

		$fileInfo = $this->resourceHandlerService->buildPlayByPlayFileInfo($season);

		$this->resourceHandlerService->extractGzipFromUrl($fileInfo);
		$records = $this->resourceHandlerService->readCsvFromTemporaryStorage($fileInfo);


//		if ($season === (int)(new DateTime())->format('Y')) {
//			$this->output->writeln('<info>Set all teams to inactive</info>');
//			$this->deactivateAllTeams();
//		}
//
//		$this->initProgressBar($this->foundRows);
//
		foreach ($records as $record) {
			dump($record);
			die();
//			$this->progressBar->setMessage(sprintf(
//				'Importing %s for Team %s',
//				$record[PlayerInterface::COLUMN_PLAYER_FULLNAME],
//				$record[TeamInterface::COLUMN_TEAM_ABBREVIATION]
//			));
//
//			$team = $this->handleTeam($record[TeamInterface::COLUMN_TEAM_ABBREVIATION], $season, $interactive);
//			$player = $this->handlePlayer($record);
//			$this->handleRosterAssignment($season, $record, $team, $player);
//
//			$this->progressBar->advance();
		}
//
//		$this->progressBar->setMessage(sprintf(
//			'Import for season %s finished.', $season
//		));
//		$this->progressBar->finish();
//
//		$this->entityManager->clear();
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
		$player = $this->playerConverter->toEntity($record);

		$this->entityManager->persist($player);
		$this->entityManager->flush();

		/**
		 * @todo: other "handleX"-methods like this one!
		 */

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
