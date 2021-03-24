<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\CsvConverter;

use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play\TeamAssignment;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play\TeamAssignmentInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Repository\TeamRepository;

class TeamAssignmentConverter extends AbstractCsvConverter implements TeamAssignmentConverterInterface
{
	use AssignmentConverterTrait;

	public static array $columnToTypeMapping = [
		TeamAssignmentConverterInterface::COLUMN_POSTEAM                     => TeamAssignmentInterface::TEAM_ASSIGNMENT_TYPE_POSSESSION,
		TeamAssignmentConverterInterface::COLUMN_DEFTEAM                     => TeamAssignmentInterface::TEAM_ASSIGNMENT_TYPE_DEFENSE,
		TeamAssignmentConverterInterface::COLUMN_TIMEOUT_TEAM                => TeamAssignmentInterface::TEAM_ASSIGNMENT_TYPE_TIMEOUT,
		TeamAssignmentConverterInterface::COLUMN_TD_TEAM                     => TeamAssignmentInterface::TEAM_ASSIGNMENT_TYPE_TOUCHDOWN,
		TeamAssignmentConverterInterface::COLUMN_FORCED_FUMBLE_PLAYER_1_TEAM => TeamAssignmentInterface::TEAM_ASSIGNMENT_TYPE_FORCED_FUMBLE,
		TeamAssignmentConverterInterface::COLUMN_FORCED_FUMBLE_PLAYER_2_TEAM => TeamAssignmentInterface::TEAM_ASSIGNMENT_TYPE_FORCED_FUMBLE,
		TeamAssignmentConverterInterface::COLUMN_SOLO_TACKLE_1_TEAM          => TeamAssignmentInterface::TEAM_ASSIGNMENT_TYPE_SOLO_TACKLE,
		TeamAssignmentConverterInterface::COLUMN_SOLO_TACKLE_2_TEAM          => TeamAssignmentInterface::TEAM_ASSIGNMENT_TYPE_SOLO_TACKLE,
		TeamAssignmentConverterInterface::COLUMN_ASSIST_TACKLE_1_TEAM        => TeamAssignmentInterface::TEAM_ASSIGNMENT_TYPE_ASSIST_TACKLE,
		TeamAssignmentConverterInterface::COLUMN_ASSIST_TACKLE_2_TEAM        => TeamAssignmentInterface::TEAM_ASSIGNMENT_TYPE_ASSIST_TACKLE,
		TeamAssignmentConverterInterface::COLUMN_ASSIST_TACKLE_3_TEAM        => TeamAssignmentInterface::TEAM_ASSIGNMENT_TYPE_ASSIST_TACKLE,
		TeamAssignmentConverterInterface::COLUMN_ASSIST_TACKLE_4_TEAM        => TeamAssignmentInterface::TEAM_ASSIGNMENT_TYPE_ASSIST_TACKLE,
		TeamAssignmentConverterInterface::COLUMN_TACKLE_WITH_ASSIST_1_TEAM   => TeamAssignmentInterface::TEAM_ASSIGNMENT_TYPE_TACKLE_WITH_ASSIST,
		TeamAssignmentConverterInterface::COLUMN_TACKLE_WITH_ASSIST_2_TEAM   => TeamAssignmentInterface::TEAM_ASSIGNMENT_TYPE_TACKLE_WITH_ASSIST,
		TeamAssignmentConverterInterface::COLUMN_FUMBLED_1_TEAM              => TeamAssignmentInterface::TEAM_ASSIGNMENT_TYPE_FUMBLED,
		TeamAssignmentConverterInterface::COLUMN_FUMBLED_2_TEAM              => TeamAssignmentInterface::TEAM_ASSIGNMENT_TYPE_FUMBLED,
		TeamAssignmentConverterInterface::COLUMN_FUMBLE_RECOVERY_1_TEAM      => TeamAssignmentInterface::TEAM_ASSIGNMENT_TYPE_FUMBLE_RECOVERY,
		TeamAssignmentConverterInterface::COLUMN_FUMBLE_RECOVERY_2_TEAM      => TeamAssignmentInterface::TEAM_ASSIGNMENT_TYPE_FUMBLE_RECOVERY,
		TeamAssignmentConverterInterface::COLUMN_RETURN_TEAM                 => TeamAssignmentInterface::TEAM_ASSIGNMENT_TYPE_RETURN,
		TeamAssignmentConverterInterface::COLUMN_PENALTY_TEAM                => TeamAssignmentInterface::TEAM_ASSIGNMENT_TYPE_PENALTY
	];

	public static array $columnToYardsMapping = [
		TeamAssignmentConverterInterface::COLUMN_FUMBLE_RECOVERY_1_TEAM => TeamAssignmentConverterInterface::COLUMN_FUMBLE_RECOVERY_1_YARDS,
		TeamAssignmentConverterInterface::COLUMN_FUMBLE_RECOVERY_2_TEAM => TeamAssignmentConverterInterface::COLUMN_FUMBLE_RECOVERY_2_YARDS,
		TeamAssignmentConverterInterface::COLUMN_RETURN_TEAM            => TeamAssignmentConverterInterface::COLUMN_RETURN_YARDS,
		TeamAssignmentConverterInterface::COLUMN_PENALTY_TEAM           => TeamAssignmentConverterInterface::COLUMN_PENALTY_YARDS
	];

	public static array $columnToOrderNumberMapping = [
		TeamAssignmentConverterInterface::COLUMN_FORCED_FUMBLE_PLAYER_1_TEAM => 1,
		TeamAssignmentConverterInterface::COLUMN_FORCED_FUMBLE_PLAYER_2_TEAM => 2,
		TeamAssignmentConverterInterface::COLUMN_SOLO_TACKLE_1_TEAM          => 1,
		TeamAssignmentConverterInterface::COLUMN_SOLO_TACKLE_2_TEAM          => 2,
		TeamAssignmentConverterInterface::COLUMN_ASSIST_TACKLE_1_TEAM        => 1,
		TeamAssignmentConverterInterface::COLUMN_ASSIST_TACKLE_2_TEAM        => 2,
		TeamAssignmentConverterInterface::COLUMN_ASSIST_TACKLE_3_TEAM        => 3,
		TeamAssignmentConverterInterface::COLUMN_ASSIST_TACKLE_4_TEAM        => 4,
		TeamAssignmentConverterInterface::COLUMN_TACKLE_WITH_ASSIST_1_TEAM   => 1,
		TeamAssignmentConverterInterface::COLUMN_TACKLE_WITH_ASSIST_2_TEAM   => 2,
		TeamAssignmentConverterInterface::COLUMN_FUMBLED_1_TEAM              => 1,
		TeamAssignmentConverterInterface::COLUMN_FUMBLED_2_TEAM              => 2,
		TeamAssignmentConverterInterface::COLUMN_FUMBLE_RECOVERY_1_TEAM      => 1,
		TeamAssignmentConverterInterface::COLUMN_FUMBLE_RECOVERY_2_TEAM      => 2
	];

	private TeamRepository $teamRepository;

	public function __construct(
		TeamRepository $teamRepository
	) {
		$this->teamRepository = $teamRepository;
	}

	public function defineEntityClass()
	{
		$this->entityClass = TeamAssignment::class;
	}

	public function buildTeamAssignments(array $record): iterable
	{
		foreach (static::$columnToTypeMapping as $column => $type) {
			if ($record[$column] !== CsvConverterInterface::FIELD_VALUE_NOT_AVAILABLE) {
				$team = $this->teamRepository->findOneBy([
					TeamRepository::FIELD_ABBREVIATION => $record[$column]
				]);
				if (!$team) {
					continue;
				}

				$teamAssignment = new TeamAssignment();
				$teamAssignment->setType($type);
				$teamAssignment->setOrderNumber(
					$this->mapOrderNumber($column)
				);

				$teamAssignment->setTeam($team);
				$teamAssignment->setYards(
					$this->mapYards($column, $record)
				);

				yield $teamAssignment;
			}
		}
	}
}
