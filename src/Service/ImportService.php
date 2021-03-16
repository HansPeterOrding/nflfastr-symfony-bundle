<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Service;

use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use HansPeterOrding\NflFastrSymfonyBundle\CsvConverter\RosterAssignmentConverterInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Player\RosterAssignment;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\PlayerInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\TeamInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Repository\TeamRepository;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportService
{
	private ResourceHandlerService $resourceHandlerService;

	private EntityManagerInterface $entityManager;

	private RosterAssignmentConverterInterface $rosterAssignmentConverter;

	private TeamRepository $teamRepository;

	private InputInterface $input;

	private OutputInterface $output;

	private int $foundRows = 0;

	private ?ProgressBar $progressBar = null;

	public function __construct(
		ResourceHandlerService $resourceHandlerService,
		EntityManagerInterface $entityManager,
		RosterAssignmentConverterInterface $rosterAssignmentConverter,
		TeamRepository $teamRepository
	) {
		$this->resourceHandlerService = $resourceHandlerService;
		$this->entityManager = $entityManager;
		$this->rosterAssignmentConverter = $rosterAssignmentConverter;
		$this->teamRepository = $teamRepository;
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

		$this->initProgressBar($this->resourceHandlerService->getFoundRows());

		foreach ($records as $record) {
			$this->progressBar->setMessage(sprintf(
				'Importing %s for Team %s',
				$record[PlayerInterface::COLUMN_PLAYER_FULLNAME],
				$record[TeamInterface::COLUMN_TEAM_ABBREVIATION]
			));

			$this->handleRosterDataRecord($record);

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

	private function handleRosterDataRecord(array $record): RosterAssignment
	{
		$rosterAssignment = $this->rosterAssignmentConverter->toEntity($record);

		$this->entityManager->persist($rosterAssignment);
		$this->entityManager->flush();

		return $rosterAssignment;
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
