<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\CsvConverter;

use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play\Flags;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play\FlagsInterface;

class FlagsConverter extends AbstractCsvConverter implements FlagsConverterInterface
{
	public function defineEntityClass()
	{
		$this->entityClass = Flags::class;
	}

	public function toEntity(array $record): Flags
	{
		$flags = new Flags();

		$flags->setShotgun(static::toBool($record[FlagsInterface::COLUMN_SHOTGUN]));
		$flags->setNoHuddle(static::toBool($record[FlagsInterface::COLUMN_NO_HUDDLE]));
		$flags->setQbDropback(static::toBool($record[FlagsInterface::COLUMN_QB_DROPBACK]));
		$flags->setQbKneel(static::toBool($record[FlagsInterface::COLUMN_QB_KNEEL]));
		$flags->setQbSpike(static::toBool($record[FlagsInterface::COLUMN_QB_SPIKE]));
		$flags->setQbScramble(static::toBool($record[FlagsInterface::COLUMN_QB_SCRAMBLE]));
		$flags->setPuntBlocked(static::toBool($record[FlagsInterface::COLUMN_PUNT_BLOCKED]));
		$flags->setOutOfBounds(static::toBool($record[FlagsInterface::COLUMN_OUT_OF_BOUNDS]));
		$flags->setFirstDownRush(static::toBool($record[FlagsInterface::COLUMN_FIRST_DOWN_RUSH]));
		$flags->setFirstDownPass(static::toBool($record[FlagsInterface::COLUMN_FIRST_DOWN_PASS]));
		$flags->setFirstDownPenalty(static::toBool($record[FlagsInterface::COLUMN_FIRST_DOWN_PENALTY]));
		$flags->setThirdDownConverted(static::toBool($record[FlagsInterface::COLUMN_THIRD_DOWN_CONVERTED]));
		$flags->setThirdDownFailed(static::toBool($record[FlagsInterface::COLUMN_THIRD_DOWN_CONVERTED]));
		$flags->setFourthDownConverted(static::toBool($record[FlagsInterface::COLUMN_FOURTH_DOWN_CONVERTED]));
		$flags->setFourthDownFailed(static::toBool($record[FlagsInterface::COLUMN_FOURTH_DOWN_FAILED]));
		$flags->setIncompletePass(static::toBool($record[FlagsInterface::COLUMN_INCOMPLETE_PASS]));
		$flags->setTouchback(static::toBool($record[FlagsInterface::COLUMN_TOUCHBACK]));
		$flags->setInterception(static::toBool($record[FlagsInterface::COLUMN_INTERCEPTION]));
		$flags->setPuntInsideTwenty(static::toBool($record[FlagsInterface::COLUMN_PUNT_INSIDE_TWENTY]));
		$flags->setPuntInEndzone(static::toBool($record[FlagsInterface::COLUMN_PUNT_IN_ENDZONE]));
		$flags->setPuntOutOfBounds(static::toBool($record[FlagsInterface::COLUMN_PUNT_OUT_OF_BOUNDS]));
		$flags->setPuntDowned(static::toBool($record[FlagsInterface::COLUMN_PUNT_DOWNED]));
		$flags->setPuntFairCatch(static::toBool($record[FlagsInterface::COLUMN_PUNT_FAIR_CATCH]));
		$flags->setKickoffInsideTwenty(static::toBool($record[FlagsInterface::COLUMN_KICKOFF_INSIDE_TWENTY]));
		$flags->setKickoffInEndzone(static::toBool($record[FlagsInterface::COLUMN_KICKOFF_IN_ENDZONE]));
		$flags->setKickoffOutOfBounds(static::toBool($record[FlagsInterface::COLUMN_KICKOFF_OUT_OF_BOUNDS]));
		$flags->setKickoffDowned(static::toBool($record[FlagsInterface::COLUMN_KICKOFF_DOWNED]));
		$flags->setKickoffFairCatch(static::toBool($record[FlagsInterface::COLUMN_KICKOFF_FAIR_CATCH]));
		$flags->setFumbleForced(static::toBool($record[FlagsInterface::COLUMN_FUMBLE_FORCED]));
		$flags->setFumbleNotForced(static::toBool($record[FlagsInterface::COLUMN_FUMBLE_NOT_FORCED]));
		$flags->setFumbleOutOfBounds(static::toBool($record[FlagsInterface::COLUMN_FUMBLE_OUT_OF_BOUNDS]));
		$flags->setSoloTackle(static::toBool($record[FlagsInterface::COLUMN_SOLO_TACKLE]));
		$flags->setSafety(static::toBool($record[FlagsInterface::COLUMN_SAFETY]));
		$flags->setPenalty(static::toBool($record[FlagsInterface::COLUMN_PENALTY]));
		$flags->setTackledForLoss(static::toBool($record[FlagsInterface::COLUMN_TACKLED_FOR_LOSS]));
		$flags->setFumbleLost(static::toBool($record[FlagsInterface::COLUMN_FUMBLE_LOST]));
		$flags->setOwnKickoffRecovery(static::toBool($record[FlagsInterface::COLUMN_OWN_KICKOFF_RECOVERY]));
		$flags->setOwnKickoffRecoveryTd(static::toBool($record[FlagsInterface::COLUMN_OWN_KICKOFF_RECOVERY_TD]));
		$flags->setQbHit(static::toBool($record[FlagsInterface::COLUMN_QB_HIT]));
		$flags->setRushAttempt(static::toBool($record[FlagsInterface::COLUMN_RUSH_ATTEMPT]));
		$flags->setPassAttempt(static::toBool($record[FlagsInterface::COLUMN_PASS_ATTEMPT]));
		$flags->setSack(static::toBool($record[FlagsInterface::COLUMN_SACK]));
		$flags->setTouchdown(static::toBool($record[FlagsInterface::COLUMN_TOUCHDOWN]));
		$flags->setPassTouchdown(static::toBool($record[FlagsInterface::COLUMN_PASS_TOUCHDOWN]));
		$flags->setRushTouchdown(static::toBool($record[FlagsInterface::COLUMN_RUSH_TOUCHDOWN]));
		$flags->setReturnTouchdown(static::toBool($record[FlagsInterface::COLUMN_RETURN_TOUCHDOWN]));
		$flags->setExtraPointAttempt(static::toBool($record[FlagsInterface::COLUMN_EXTRA_POINT_ATTEMPT]));
		$flags->setTwoPointAttempt(static::toBool($record[FlagsInterface::COLUMN_TWO_POINT_ATTEMPT]));
		$flags->setFieldGoalAttempt(static::toBool($record[FlagsInterface::COLUMN_FIELD_GOAL_ATTEMPT]));
		$flags->setKickoffAttempt(static::toBool($record[FlagsInterface::COLUMN_KICKOFF_ATTEMPT]));
		$flags->setPuntAttempt(static::toBool($record[FlagsInterface::COLUMN_PUNT_ATTEMPT]));
		$flags->setFumble(static::toBool($record[FlagsInterface::COLUMN_FUMBLE]));
		$flags->setCompletePass(static::toBool($record[FlagsInterface::COLUMN_COMPLETE_PASS]));
		$flags->setAssistTackle(static::toBool($record[FlagsInterface::COLUMN_ASSIST_TACKLE]));
		$flags->setLateralReception(static::toBool($record[FlagsInterface::COLUMN_LATERAL_RECEPTION]));
		$flags->setLateralRush(static::toBool($record[FlagsInterface::COLUMN_LATERAL_RUSH]));
		$flags->setLateralReturn(static::toBool($record[FlagsInterface::COLUMN_LATERAL_RETURN]));
		$flags->setLateralRecovery(static::toBool($record[FlagsInterface::COLUMN_LATERAL_RECOVERY]));
		$flags->setSpecial(static::toBool($record[FlagsInterface::COLUMN_SPECIAL]));

		return $flags;
	}
}
