<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\MessageHandler\RosterImport;

use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\PlayInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\GameInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\PlayerInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\TeamInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Message\PlayByPlayImport\ImportPlayRecordMessage;
use HansPeterOrding\NflFastrSymfonyBundle\Message\RosterImport\ImportRosterRecordMessage;
use HansPeterOrding\NflFastrSymfonyBundle\Service\ImportService;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;

class ImportRosterRecordMessageHandler implements MessageHandlerInterface, LoggerAwareInterface
{
	use LoggerAwareTrait;

	private ImportService $importService;

	public function __construct(
		ImportService $importService
	)
	{
		$this->importService = $importService;
	}

	public function __invoke(ImportRosterRecordMessage $message)
	{
		$record = $message->getRecord();

		$this->logger->info(sprintf(
			'Handling record for player %s for Team %s',
			$record[PlayerInterface::COLUMN_PLAYER_FULLNAME],
			$record[TeamInterface::COLUMN_TEAM_ABBREVIATION]
		));

		$rosterAssignment = $this->importService->handleRosterRecord($record);

		$this->logger->info(sprintf('Record imported.'));
	}
}
