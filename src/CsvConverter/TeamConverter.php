<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\CsvConverter;

use DateTime;
use Doctrine\DBAL\Types\ConversionException;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Team;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\TeamInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Repository\TeamRepository;

/**
 * @method getOrCreateEntity(array $data): ?Team
 */
class TeamConverter extends AbstractCsvConverter implements TeamConverterInterface
{
	public function __construct(
		TeamRepository $repository
	)
	{
		$this->repository = $repository;
	}

	public function defineEntityClass()
	{
		$this->entityClass = Team::class;
	}

	public function toEntity(array $record): Team
	{
		$season = (int)$record[TeamInterface::COLUMN_SEASON];

		$team = $this->getOrCreateEntity($record);

		$team->setAbbreviation(static::toString($record[TeamInterface::COLUMN_TEAM_ABBREVIATION]));

		$teamName = constant("HansPeterOrding\NflFastrSymfonyBundle\Entity\TeamInterface::TEAM_TITLE_" . $team->getAbbreviation());
		if ($teamName === null) {
			throw new ConversionException(sprintf('<error>No default team title found for %s</error>', $team->getAbbreviation()));
		}

		$team->setName($teamName);
		if ($season === (int)(new DateTime())->format('Y')) {
			$team->setStatus(TeamInterface::STATUS_ACTIVE);
		}

		return $team;
	}
}
