<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Service;

use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use HansPeterOrding\NflFastrSymfonyBundle\CsvConverter\PlayConverterInterface;
use HansPeterOrding\NflFastrSymfonyBundle\CsvConverter\RosterAssignmentConverterInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\PlayInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\GameInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Player\RosterAssignment;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\PlayerInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\TeamInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Message\PlayByPlayImport\ImportPlayRecordMessage;
use HansPeterOrding\NflFastrSymfonyBundle\Message\RosterImport\ImportRosterRecordMessage;
use HansPeterOrding\NflFastrSymfonyBundle\Repository\PlayRepository;
use HansPeterOrding\NflFastrSymfonyBundle\Repository\TeamRepository;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class ImportService
{
	private ResourceHandlerService $resourceHandlerService;

	private EntityManagerInterface $entityManager;

	private RosterAssignmentConverterInterface $rosterAssignmentConverter;

	private PlayConverterInterface $playConverter;

	private TeamRepository $teamRepository;

	private PlayRepository $playRepository;

	private MessageBusInterface $messageBus;

	private InputInterface $input;

	private OutputInterface $output;

	private int $foundRows = 0;

	private ?ProgressBar $progressBar = null;

	public function __construct(
		ResourceHandlerService $resourceHandlerService,
		EntityManagerInterface $entityManager,
		RosterAssignmentConverterInterface $rosterAssignmentConverter,
		PlayConverterInterface $playConverter,
		TeamRepository $teamRepository,
		PlayRepository $playRepository,
		MessageBusInterface $messageBus
	) {
		$this->resourceHandlerService = $resourceHandlerService;
		$this->entityManager = $entityManager;
		$this->rosterAssignmentConverter = $rosterAssignmentConverter;
		$this->playConverter = $playConverter;
		$this->teamRepository = $teamRepository;
		$this->playRepository = $playRepository;
		$this->messageBus = $messageBus;
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

	public function importRosterSeason(int $season)
	{
		$this->output->writeln(sprintf('<info>Starting import of season %s</info>', $season));

		$fileInfo = $this->resourceHandlerService->buildRosterFileInfo($season);
		$records = $this->resourceHandlerService->readCsvFromUrl($fileInfo);

		if ($season === (int)(new DateTime())->format('Y')) {
			$this->output->writeln('<info>Set all teams to inactive</info>');
			$this->deactivateAllTeams();
		}

		$this->initProgressBar($this->resourceHandlerService->getFoundRows());

		foreach ($records as $record) {
			$this->progressBar->setMessage(sprintf(
				'Importing %s for Team %s',
				$record[PlayerInterface::COLUMN_PLAYER_FULLNAME],
				$record[TeamInterface::COLUMN_TEAM_ABBREVIATION]
			));

			$this->handleRosterRecord($record);

			$this->progressBar->advance();
		}

		$this->progressBar->setMessage(sprintf(
			'Import for season %s finished.', $season
		));
		$this->progressBar->finish();

		$this->entityManager->clear();
	}

	public function importPlayByPlaySeason(int $season, int $counter, bool $skipUpdates, ?int $limit): int
	{
		$finishedMessage = sprintf('Import for season %s finished.', $season);
		$this->output->writeln(sprintf('<info>Starting import of season %s</info>', $season));

		$fileInfo = $this->resourceHandlerService->buildPlayByPlayFileInfo($season);

		$this->resourceHandlerService->extractGzipFromUrl($fileInfo);
		$records = $this->resourceHandlerService->readCsvFromTemporaryStorage($fileInfo);

		$this->initProgressBar($this->resourceHandlerService->getFoundRows());

		foreach ($records as $record) {
			$this->progressBar->setMessage(sprintf(
				'Importing play ID %s from game ID %s in drive %s',
				$record[PlayInterface::COLUMN_PLAY_ID],
				$record[GameInterface::COLUMN_GAME_ID],
				$record[PlayInterface::COLUMN_DRIVE]
			));

			$play = $this->handlePlayRecord($record, $skipUpdates);
			if ($play) {
				$counter++;
			}

			$this->progressBar->advance();

			if ($limit && $counter >= $limit) {
				$finishedMessage = sprintf('Import for season %s aborted after limit of %s plays', $season, $limit);
				break;
			}
		}

		$this->progressBar->setMessage($finishedMessage);
		$this->progressBar->finish();

		$this->entityManager->clear();

		return $counter;
	}

	public function initializePlayByPlaySeason(int $season, bool $skipUpdates, int $limit = 0, int $offset = 0)
	{
		$message = sprintf('<info>Starting initialization of season %s with limit %s and offset %s</info>', $season, $limit, $offset);
		$this->output->writeln($message);

		$fileInfo = $this->resourceHandlerService->buildPlayByPlayFileInfo($season);

		$this->resourceHandlerService->extractGzipFromUrl($fileInfo);
		$records = $this->resourceHandlerService->readCsvFromTemporaryStorage($fileInfo);

		$this->initProgressBar($this->resourceHandlerService->getFoundRows());

		$counter = 0;
		foreach ($records as $record) {
			$this->progressBar->setMessage(sprintf(
				'Creating import message for play ID %s from game ID %s in drive %s',
				$record[PlayInterface::COLUMN_PLAY_ID],
				$record[GameInterface::COLUMN_GAME_ID],
				$record[PlayInterface::COLUMN_DRIVE]
			));

			if($offset === 0 || $counter >= $offset) {
				$this->handlePlayRecordMessage($season, $record, $skipUpdates);
			}
			$counter++;
			if($limit > 0 && $counter - $offset >= $limit) {
				break;
			}

			$this->progressBar->advance();
		}

		$this->progressBar->setMessage(sprintf('Initialization for season %s finished.', $season));
		$this->progressBar->finish();

		$this->entityManager->clear();
	}

	public function initializeRosterSeason(int $season)
	{
		$this->output->writeln(sprintf('<info>Starting initialization of season %s</info>', $season));

		$fileInfo = $this->resourceHandlerService->buildRosterFileInfo($season);
		$records = $this->resourceHandlerService->readCsvFromUrl($fileInfo);

		if ($season === (int)(new DateTime())->format('Y')) {
			$this->output->writeln('<info>Set all teams to inactive</info>');
			$this->deactivateAllTeams();
		}

		$this->initProgressBar($this->resourceHandlerService->getFoundRows());

		foreach ($records as $record) {
			$this->progressBar->setMessage(sprintf(
				'Creating import message for player %s for Team %s',
				$record[PlayerInterface::COLUMN_PLAYER_FULLNAME],
				$record[TeamInterface::COLUMN_TEAM_ABBREVIATION]
			));

			$this->handleRosterRecordMessage($record);

			$this->progressBar->advance();
		}

		$this->progressBar->setMessage(sprintf('Initialization for season %s finished.', $season));
		$this->progressBar->finish();

		$this->entityManager->clear();
	}

	private function deactivateAllTeams()
	{
		$this->teamRepository->deactivateAll();
	}

	public function handleRosterRecord(array $record): RosterAssignment
	{
		$rosterAssignment = $this->rosterAssignmentConverter->toEntity($record);

		$this->entityManager->persist($rosterAssignment);
		$this->entityManager->flush();

		$this->entityManager->clear();

		return $rosterAssignment;
	}

	public function handlePlayRecord(array $record, bool $skipUpdates): ?Play
	{
		if ($skipUpdates && $this->playRepository->playExists($record)) {
			$this->progressBar->setMessage(sprintf(
				'Skipping play ID %s',
				$record[PlayInterface::COLUMN_PLAY_ID]
			));

			return null;
		}

		$play = $this->playConverter->toEntity($record);

		$this->entityManager->persist($play);
		$this->entityManager->flush();

		$this->entityManager->clear();

		return $play;
	}

	private function handlePlayRecordMessage(int $season, array $record, bool $skipUpdates): ?ImportPlayRecordMessage
	{
		if ($skipUpdates && $this->playRepository->playExists($record)) {
			$this->progressBar->setMessage(sprintf(
				'Skipping play ID %s',
				$record[PlayInterface::COLUMN_PLAY_ID]
			));

			return null;
		}

		$importPlayRecordMessage = new ImportPlayRecordMessage();
		$importPlayRecordMessage->setSeason($season);
		$importPlayRecordMessage->setCreated(new DateTime());
		$importPlayRecordMessage->setRecord($record);
		$importPlayRecordMessage->setSkipUpdates($skipUpdates);

		$this->messageBus->dispatch($importPlayRecordMessage);

		return $importPlayRecordMessage;
	}

	private function handleRosterRecordMessage(array $record): ?ImportRosterRecordMessage
	{
		$importPlayRecordMessage = new ImportRosterRecordMessage();
		$importPlayRecordMessage->setCreated(new DateTime());
		$importPlayRecordMessage->setRecord($record);

		$this->messageBus->dispatch($importPlayRecordMessage);

		return $importPlayRecordMessage;
	}

	private function initProgressBar(int $max)
	{
		ProgressBar::setFormatDefinition(
			'custom',
			"%bar% %current%/%max% (%percent%%)\nElapsed time: %elapsed:-80s%\nRemaining time: %remaining:-80s%\nEstimated time: %estimated:-80s%\nMemory used: %memory:-80s% \n%message:-80s%\n\n"
		);
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
