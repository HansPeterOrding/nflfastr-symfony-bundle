<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\CsvConverter;

use HansPeterOrding\NflFastrSymfonyBundle\Entity\Player\RosterAssignment;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Player\RosterAssignmentInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Repository\RosterAssignmentRepository;

class RosterAssignmentConverter extends AbstractCsvConverter implements RosterAssignmentConverterInterface
{
	public static array $statusMappings = [
		'ACT'                          => RosterAssignmentInterface::STATUS_ACTIVE,
		'Active'                       => RosterAssignmentInterface::STATUS_ACTIVE,
		'CUT'                          => RosterAssignmentInterface::STATUS_INACTIVE,
		'DEV'                          => RosterAssignmentInterface::STATUS_PRACTICE_SQUAD,
		'EXE'                          => RosterAssignmentInterface::STATUS_INACTIVE,
		'Inactive'                     => RosterAssignmentInterface::STATUS_INACTIVE,
		'Injured Reserve'              => RosterAssignmentInterface::STATUS_INJURED_RESERVE,
		'NA'                           => RosterAssignmentInterface::STATUS_INACTIVE,
		'NON'                          => RosterAssignmentInterface::STATUS_INACTIVE,
		'NWT'                          => RosterAssignmentInterface::STATUS_INACTIVE,
		'Physically Unable to Perform' => RosterAssignmentInterface::STATUS_PHYSICALLY_UNABLE_TO_PERFORM,
		'Practice Squad'               => RosterAssignmentInterface::STATUS_PRACTICE_SQUAD,
		'PUP'                          => RosterAssignmentInterface::STATUS_PHYSICALLY_UNABLE_TO_PERFORM,
		'RES'                          => RosterAssignmentInterface::STATUS_INJURED_RESERVE,
		'Reserve/COVID-19'             => RosterAssignmentInterface::STATUS_RESERVE_COVID,
		'RET'                          => RosterAssignmentInterface::STATUS_INACTIVE,
		'RFA'                          => RosterAssignmentInterface::STATUS_INACTIVE,
		'RSN'                          => RosterAssignmentInterface::STATUS_INACTIVE,
		'SUS'                          => RosterAssignmentInterface::STATUS_INACTIVE,
		'TRC'                          => RosterAssignmentInterface::STATUS_INACTIVE,
		'TRD'                          => RosterAssignmentInterface::STATUS_INACTIVE,
		'TRT'                          => RosterAssignmentInterface::STATUS_INACTIVE,
		'UDF'                          => RosterAssignmentInterface::STATUS_INACTIVE,
		'UFA'                          => RosterAssignmentInterface::STATUS_INACTIVE,
		'Voluntary Opt Out'            => RosterAssignmentInterface::STATUS_VOLUNTARY_OPT_OUT
	];

	private TeamConverterInterface $teamConverter;

	private PlayerConverterInterface $playerConverter;

	public function __construct(
		RosterAssignmentRepository $repository,
		TeamConverterInterface $teamConverter,
		PlayerConverterInterface $playerConverter
	) {
		$this->repository = $repository;

		$this->teamConverter = $teamConverter;
		$this->playerConverter = $playerConverter;
	}

	public function defineEntityClass()
	{
		$this->entityClass = RosterAssignment::class;
	}

	public function toEntity(array $record): RosterAssignment
	{
		$player = $this->playerConverter->toEntity($record);
		$team = $this->teamConverter->toEntity($record);

		$record[RosterAssignmentInterface::COLUMN_ROSTERASSIGNMENT_PLAYER] = $player->getId();

		/** @var RosterAssignment $rosterAssignment */
		$rosterAssignment = $this->getOrCreateEntity($record);

		$rosterAssignment->setTeam($team);
		$rosterAssignment->setPlayer($player);
		
		$rosterAssignment->setSeason(static::toInt($record[RosterAssignmentInterface::COLUMN_ROSTERASSIGNMENT_SEASON]));
		$rosterAssignment->setPosition(static::toString($record[RosterAssignmentInterface::COLUMN_ROSTERASSIGNMENT_POSITION]));
		$rosterAssignment->setDepthChartPosition(static::toString($record[RosterAssignmentInterface::COLUMN_ROSTERASSIGNMENT_DEPTH_CHART_POSITION]));
		$rosterAssignment->setJerseyNumber(static::toInt($record[RosterAssignmentInterface::COLUMN_ROSTERASSIGNMENT_JERSEY_NUMBER]));
		$rosterAssignment->setStatus(
			static::$statusMappings[$record[RosterAssignmentInterface::COLUMN_ROSTERASSIGNMENT_STATUS]]
		);

		return $rosterAssignment;
	}
}
