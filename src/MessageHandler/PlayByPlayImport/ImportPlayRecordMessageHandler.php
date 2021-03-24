<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\MessageHandler\PlayByPlayImport;

use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\PlayInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\GameInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Message\PlayByPlayImport\ImportPlayRecordMessage;
use HansPeterOrding\NflFastrSymfonyBundle\Service\ImportService;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;

class ImportPlayRecordMessageHandler implements MessageHandlerInterface, LoggerAwareInterface
{
	use LoggerAwareTrait;

	private ImportService $importService;

	public function __construct(
		ImportService $importService
	) {
		$this->importService = $importService;
	}

	public function __invoke(ImportPlayRecordMessage $message)
	{
		$record = $message->getRecord();
		$skipUpdates = $message->isSkipUpdates();

		$this->logger->info(sprintf(
			'Handling record for play ID %s from game ID %s in drive %s',
			$record[PlayInterface::COLUMN_PLAY_ID],
			$record[GameInterface::COLUMN_GAME_ID],
			$record[PlayInterface::COLUMN_DRIVE]
		));

		$play = $this->importService->handlePlayRecord($record, $skipUpdates);

		if ($play) {
			$this->logger->info(sprintf('Record imported.'));
		} else {
			$this->logger->info(sprintf('Record skipped.'));
		}
	}
}
