<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\CsvConverter;

use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play\PlayerAssignment;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play\PlayerAssignmentInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\PlayerInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Repository\PlayerRepository;

class PlayerAssignmentConverter extends AbstractCsvConverter implements PlayerAssignmentConverterInterface
{
	use AssignmentConverterTrait;

	public static array $columnToTypeMapping = [
		PlayerAssignmentConverterInterface::COLUMN_TD_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_TD,
		PlayerAssignmentConverterInterface::COLUMN_PASSER_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_PASSER,
		PlayerAssignmentConverterInterface::COLUMN_RECEIVER_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_RECEIVER,
		PlayerAssignmentConverterInterface::COLUMN_RUSHER_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_RUSHER,
		PlayerAssignmentConverterInterface::COLUMN_LATERAL_RECEIVER_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_LATERAL_RECEIVER,
		PlayerAssignmentConverterInterface::COLUMN_LATERAL_RUSHER_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_LATERAL_RUSHER,
		PlayerAssignmentConverterInterface::COLUMN_LATERAL_SACK_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_LATERAL_SACK,
		PlayerAssignmentConverterInterface::COLUMN_INTERCEPTION_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_INTERCEPTION,
		PlayerAssignmentConverterInterface::COLUMN_LATERAL_INTERCEPTION_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_LATERAL_INTERCEPTION,
		PlayerAssignmentConverterInterface::COLUMN_PUNT_RETURNER_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_PUNT_RETURNER,
		PlayerAssignmentConverterInterface::COLUMN_LATERAL_PUNT_RETURNER_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_LATERAL_PUNT_RETURNER,
		PlayerAssignmentConverterInterface::COLUMN_KICKOFF_RETURNER_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_KICKOFF_RETURNER,
		PlayerAssignmentConverterInterface::COLUMN_LATERAL_KICKOFF_RETURNER_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_LATERAL_KICKOFF_RETURNER,
		PlayerAssignmentConverterInterface::COLUMN_PUNTER_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_PUNTER,
		PlayerAssignmentConverterInterface::COLUMN_KICKER_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_KICKER,
		PlayerAssignmentConverterInterface::COLUMN_OWN_KICKOFF_RECOVERY_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_OWN_KICKOFF_RECOVERY,
		PlayerAssignmentConverterInterface::COLUMN_BLOCKED_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_BLOCKED,
		PlayerAssignmentConverterInterface::COLUMN_TACKLE_FOR_LOSS_1_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_TACKLE_FOR_LOSS,
		PlayerAssignmentConverterInterface::COLUMN_TACKLE_FOR_LOSS_2_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_TACKLE_FOR_LOSS,
		PlayerAssignmentConverterInterface::COLUMN_QB_HIT_1_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_QB_HIT,
		PlayerAssignmentConverterInterface::COLUMN_QB_HIT_2_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_QB_HIT,
		PlayerAssignmentConverterInterface::COLUMN_FORCED_FUMBLE_PLAYER_1_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_FORCED_FUMBLE,
		PlayerAssignmentConverterInterface::COLUMN_FORCED_FUMBLE_PLAYER_2_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_FORCED_FUMBLE,
		PlayerAssignmentConverterInterface::COLUMN_SOLO_TACKLE_1_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_SOLO_TACKLE,
		PlayerAssignmentConverterInterface::COLUMN_SOLO_TACKLE_2_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_SOLO_TACKLE,
		PlayerAssignmentConverterInterface::COLUMN_ASSIST_TACKLE_1_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_ASSIST_TACKLE,
		PlayerAssignmentConverterInterface::COLUMN_ASSIST_TACKLE_2_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_ASSIST_TACKLE,
		PlayerAssignmentConverterInterface::COLUMN_ASSIST_TACKLE_3_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_ASSIST_TACKLE,
		PlayerAssignmentConverterInterface::COLUMN_ASSIST_TACKLE_4_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_ASSIST_TACKLE,
		PlayerAssignmentConverterInterface::COLUMN_TACKLE_WITH_ASSIST_1_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_TACKLE_WITH_ASSIST,
		PlayerAssignmentConverterInterface::COLUMN_TACKLE_WITH_ASSIST_2_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_TACKLE_WITH_ASSIST,
		PlayerAssignmentConverterInterface::COLUMN_PASS_DEFENSE_1_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_PASS_DEFENSE,
		PlayerAssignmentConverterInterface::COLUMN_PASS_DEFENSE_2_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_PASS_DEFENSE,
		PlayerAssignmentConverterInterface::COLUMN_FUMBLED_1_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_FUMBLED,
		PlayerAssignmentConverterInterface::COLUMN_FUMBLED_2_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_FUMBLED,
		PlayerAssignmentConverterInterface::COLUMN_FUMBLE_RECOVERY_1_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_FUMBLE_RECOVERY,
		PlayerAssignmentConverterInterface::COLUMN_FUMBLE_RECOVERY_2_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_FUMBLE_RECOVERY,
		PlayerAssignmentConverterInterface::COLUMN_PENALTY_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_PENALTY,
		PlayerAssignmentConverterInterface::COLUMN_FANTASY_PLAYER_ID => PlayerAssignmentInterface::PLAYER_ASSIGNMENT_TYPE_FANTASY
	];
	
	public static array $columnToYardsMapping = [
		PlayerAssignmentConverterInterface::COLUMN_PASSER_PLAYER_ID => PlayerAssignmentConverterInterface::COLUMN_PASSING_YARDS,
		PlayerAssignmentConverterInterface::COLUMN_RECEIVER_PLAYER_ID => PlayerAssignmentConverterInterface::COLUMN_RECEIVING_YARDS,
		PlayerAssignmentConverterInterface::COLUMN_RUSHER_PLAYER_ID => PlayerAssignmentConverterInterface::COLUMN_RUSHING_YARDS,
		PlayerAssignmentConverterInterface::COLUMN_LATERAL_RECEIVER_PLAYER_ID => PlayerAssignmentConverterInterface::COLUMN_LATERAL_RECEIVING_YARDS,
		PlayerAssignmentConverterInterface::COLUMN_LATERAL_RUSHER_PLAYER_ID => PlayerAssignmentConverterInterface::COLUMN_LATERAL_RUSHING_YARDS,
		PlayerAssignmentConverterInterface::COLUMN_FUMBLE_RECOVERY_1_PLAYER_ID => PlayerAssignmentConverterInterface::COLUMN_FUMBLE_RECOVERY_1_YARDS,
		PlayerAssignmentConverterInterface::COLUMN_FUMBLE_RECOVERY_2_PLAYER_ID => PlayerAssignmentConverterInterface::COLUMN_FUMBLE_RECOVERY_2_YARDS,
		PlayerAssignmentConverterInterface::COLUMN_PUNT_RETURNER_PLAYER_ID => PlayerAssignmentConverterInterface::COLUMN_RETURN_YARDS,
		PlayerAssignmentConverterInterface::COLUMN_LATERAL_PUNT_RETURNER_PLAYER_ID => PlayerAssignmentConverterInterface::COLUMN_RETURN_YARDS,
		PlayerAssignmentConverterInterface::COLUMN_KICKOFF_RETURNER_PLAYER_ID => PlayerAssignmentConverterInterface::COLUMN_RETURN_YARDS,
		PlayerAssignmentConverterInterface::COLUMN_LATERAL_KICKOFF_RETURNER_PLAYER_ID => PlayerAssignmentConverterInterface::COLUMN_RETURN_YARDS,
		PlayerAssignmentConverterInterface::COLUMN_PENALTY_PLAYER_ID => PlayerAssignmentConverterInterface::COLUMN_PENALTY_YARDS
	];

	public static array $columnToOrderNumberMapping = [
		PlayerAssignmentConverterInterface::COLUMN_TACKLE_FOR_LOSS_1_PLAYER_ID => 1,
		PlayerAssignmentConverterInterface::COLUMN_TACKLE_FOR_LOSS_2_PLAYER_ID => 2,
		PlayerAssignmentConverterInterface::COLUMN_QB_HIT_1_PLAYER_ID => 1,
		PlayerAssignmentConverterInterface::COLUMN_QB_HIT_2_PLAYER_ID => 2,
		PlayerAssignmentConverterInterface::COLUMN_FORCED_FUMBLE_PLAYER_1_PLAYER_ID => 1,
		PlayerAssignmentConverterInterface::COLUMN_FORCED_FUMBLE_PLAYER_2_PLAYER_ID => 2,
		PlayerAssignmentConverterInterface::COLUMN_SOLO_TACKLE_1_PLAYER_ID => 1,
		PlayerAssignmentConverterInterface::COLUMN_SOLO_TACKLE_2_PLAYER_ID => 2,
		PlayerAssignmentConverterInterface::COLUMN_ASSIST_TACKLE_1_PLAYER_ID => 1,
		PlayerAssignmentConverterInterface::COLUMN_ASSIST_TACKLE_2_PLAYER_ID => 2,
		PlayerAssignmentConverterInterface::COLUMN_ASSIST_TACKLE_3_PLAYER_ID => 3,
		PlayerAssignmentConverterInterface::COLUMN_ASSIST_TACKLE_4_PLAYER_ID => 4,
		PlayerAssignmentConverterInterface::COLUMN_TACKLE_WITH_ASSIST_1_PLAYER_ID => 1,
		PlayerAssignmentConverterInterface::COLUMN_TACKLE_WITH_ASSIST_2_PLAYER_ID => 2,
		PlayerAssignmentConverterInterface::COLUMN_PASS_DEFENSE_1_PLAYER_ID => 1,
		PlayerAssignmentConverterInterface::COLUMN_PASS_DEFENSE_2_PLAYER_ID => 2,
		PlayerAssignmentConverterInterface::COLUMN_FUMBLED_1_PLAYER_ID => 1,
		PlayerAssignmentConverterInterface::COLUMN_FUMBLED_2_PLAYER_ID => 2,
		PlayerAssignmentConverterInterface::COLUMN_FUMBLE_RECOVERY_1_PLAYER_ID => 1,
		PlayerAssignmentConverterInterface::COLUMN_FUMBLE_RECOVERY_2_PLAYER_ID => 2
	];

	private PlayerRepository $playerRepository;

	public function __construct(
		PlayerRepository $playerRepository
	)
	{
		$this->playerRepository = $playerRepository;
	}

	public function defineEntityClass()
	{
		$this->entityClass = PlayerAssignment::class;
	}

	public function buildPlayerAssignments(array $record): iterable
	{
		foreach (static::$columnToTypeMapping as $column => $type) {
			if($record[$column] !== CsvConverterInterface::FIELD_VALUE_NOT_AVAILABLE) {
				$player = $this->playerRepository->findOneBy([
					PlayerRepository::FIELD_GSIS_ID => $record[$column]
				]);
				if(!$player) {
					continue;
				}

				$playerAssignment = new PlayerAssignment();
				$playerAssignment->setType($type);
				$playerAssignment->setOrderNumber(
					$this->mapOrderNumber($column)
				);
				$playerAssignment->setPlayer($player);
				$playerAssignment->setYards(
					$this->mapYards($column, $record)
				);

				yield $playerAssignment;
			}
		}
	}
}
