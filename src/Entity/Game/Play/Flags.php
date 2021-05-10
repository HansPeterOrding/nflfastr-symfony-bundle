<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play;

class Flags implements FlagsInterface
{
	protected bool $shotgun = false;

	protected bool $noHuddle = false;

	protected bool $qbDropback = false;

	protected bool $qbKneel = false;

	protected bool $qbSpike = false;

	protected bool $qbScramble = false;

	protected bool $puntBlocked = false;

	protected bool $outOfBounds = false;

	protected bool $firstDownRush = false;

	protected bool $firstDownPass = false;

	protected bool $firstDownPenalty = false;

	protected bool $thirdDownConverted = false;

	protected bool $thirdDownFailed = false;

	protected bool $fourthDownConverted = false;

	protected bool $fourthDownFailed = false;

	protected bool $incompletePass = false;

	protected bool $touchback = false;

	protected bool $interception = false;

	protected bool $puntInsideTwenty = false;

	protected bool $puntInEndzone = false;

	protected bool $puntOutOfBounds = false;

	protected bool $puntDowned = false;

	protected bool $puntFairCatch = false;

	protected bool $kickoffInsideTwenty = false;

	protected bool $kickoffInEndzone = false;

	protected bool $kickoffOutOfBounds = false;

	protected bool $kickoffDowned = false;

	protected bool $kickoffFairCatch = false;

	protected bool $fumbleForced = false;

	protected bool $fumbleNotForced = false;

	protected bool $fumbleOutOfBounds = false;

	protected bool $soloTackle = false;

	protected bool $safety = false;

	protected bool $penalty = false;

	protected bool $tackledForLoss = false;

	protected bool $fumbleLost = false;

	protected bool $ownKickoffRecovery = false;

	protected bool $ownKickoffRecoveryTd = false;

	protected bool $qbHit = false;

	protected bool $rushAttempt = false;

	protected bool $passAttempt = false;

	protected bool $sack = false;

	protected bool $touchdown = false;

	protected bool $passTouchdown = false;

	protected bool $rushTouchdown = false;

	protected bool $returnTouchdown = false;

	protected bool $extraPointAttempt = false;

	protected bool $twoPointAttempt = false;

	protected bool $fieldGoalAttempt = false;

	protected bool $kickoffAttempt = false;

	protected bool $puntAttempt = false;

	protected bool $fumble = false;

	protected bool $completePass = false;

	protected bool $assistTackle = false;

	protected bool $lateralReception = false;

	protected bool $lateralRush = false;

	protected bool $lateralReturn = false;

	protected bool $lateralRecovery = false;

	protected bool $special = false;

	public function isShotgun(): bool
	{
		return $this->shotgun;
	}

	public function setShotgun(bool $shotgun): self
	{
		$this->shotgun = $shotgun;

		return $this;
	}

	public function isNoHuddle(): bool
	{
		return $this->noHuddle;
	}

	public function setNoHuddle(bool $noHuddle): self
	{
		$this->noHuddle = $noHuddle;

		return $this;
	}

	public function isQbDropback(): bool
	{
		return $this->qbDropback;
	}

	public function setQbDropback(bool $qbDropback): self
	{
		$this->qbDropback = $qbDropback;

		return $this;
	}

	public function isQbKneel(): bool
	{
		return $this->qbKneel;
	}

	public function setQbKneel(bool $qbKneel): self
	{
		$this->qbKneel = $qbKneel;

		return $this;
	}

	public function isQbSpike(): bool
	{
		return $this->qbSpike;
	}

	public function setQbSpike(bool $qbSpike): self
	{
		$this->qbSpike = $qbSpike;

		return $this;
	}

	public function isQbScramble(): bool
	{
		return $this->qbScramble;
	}

	public function setQbScramble(bool $qbScramble): self
	{
		$this->qbScramble = $qbScramble;

		return $this;
	}

	public function isPuntBlocked(): bool
	{
		return $this->puntBlocked;
	}

	public function setPuntBlocked(bool $puntBlocked): self
	{
		$this->puntBlocked = $puntBlocked;

		return $this;
	}

	public function isOutOfBounds(): bool
	{
		return $this->outOfBounds;
	}

	public function setOutOfBounds(bool $outOfBounds): self
	{
		$this->outOfBounds = $outOfBounds;

		return $this;
	}

	public function isFirstDownRush(): bool
	{
		return $this->firstDownRush;
	}

	public function setFirstDownRush(bool $firstDownRush): self
	{
		$this->firstDownRush = $firstDownRush;

		return $this;
	}

	public function isFirstDownPass(): bool
	{
		return $this->firstDownPass;
	}

	public function setFirstDownPass(bool $firstDownPass): self
	{
		$this->firstDownPass = $firstDownPass;

		return $this;
	}

	public function isFirstDownPenalty(): bool
	{
		return $this->firstDownPenalty;
	}

	public function setFirstDownPenalty(bool $firstDownPenalty): self
	{
		$this->firstDownPenalty = $firstDownPenalty;

		return $this;
	}

	public function isThirdDownConverted(): bool
	{
		return $this->thirdDownConverted;
	}

	public function setThirdDownConverted(bool $thirdDownConverted): self
	{
		$this->thirdDownConverted = $thirdDownConverted;

		return $this;
	}

	public function isThirdDownFailed(): bool
	{
		return $this->thirdDownFailed;
	}

	public function setThirdDownFailed(bool $thirdDownFailed): self
	{
		$this->thirdDownFailed = $thirdDownFailed;

		return $this;
	}

	public function isFourthDownConverted(): bool
	{
		return $this->fourthDownConverted;
	}

	public function setFourthDownConverted(bool $fourthDownConverted): self
	{
		$this->fourthDownConverted = $fourthDownConverted;

		return $this;
	}

	public function isFourthDownFailed(): bool
	{
		return $this->fourthDownFailed;
	}

	public function setFourthDownFailed(bool $fourthDownFailed): self
	{
		$this->fourthDownFailed = $fourthDownFailed;

		return $this;
	}

	public function isIncompletePass(): bool
	{
		return $this->incompletePass;
	}

	public function setIncompletePass(bool $incompletePass): self
	{
		$this->incompletePass = $incompletePass;

		return $this;
	}

	public function isTouchback(): bool
	{
		return $this->touchback;
	}

	public function setTouchback(bool $touchback): self
	{
		$this->touchback = $touchback;

		return $this;
	}

	public function isInterception(): bool
	{
		return $this->interception;
	}

	public function setInterception(bool $interception): self
	{
		$this->interception = $interception;

		return $this;
	}

	public function isPuntInsideTwenty(): bool
	{
		return $this->puntInsideTwenty;
	}

	public function setPuntInsideTwenty(bool $puntInsideTwenty): self
	{
		$this->puntInsideTwenty = $puntInsideTwenty;

		return $this;
	}

	public function isPuntInEndzone(): bool
	{
		return $this->puntInEndzone;
	}

	public function setPuntInEndzone(bool $puntInEndzone): self
	{
		$this->puntInEndzone = $puntInEndzone;

		return $this;
	}

	public function isPuntOutOfBounds(): bool
	{
		return $this->puntOutOfBounds;
	}

	public function setPuntOutOfBounds(bool $puntOutOfBounds): self
	{
		$this->puntOutOfBounds = $puntOutOfBounds;

		return $this;
	}

	public function isPuntDowned(): bool
	{
		return $this->puntDowned;
	}

	public function setPuntDowned(bool $puntDowned): self
	{
		$this->puntDowned = $puntDowned;

		return $this;
	}

	public function isPuntFairCatch(): bool
	{
		return $this->puntFairCatch;
	}

	public function setPuntFairCatch(bool $puntFairCatch): self
	{
		$this->puntFairCatch = $puntFairCatch;

		return $this;
	}

	public function isKickoffInsideTwenty(): bool
	{
		return $this->kickoffInsideTwenty;
	}

	public function setKickoffInsideTwenty(bool $kickoffInsideTwenty): self
	{
		$this->kickoffInsideTwenty = $kickoffInsideTwenty;

		return $this;
	}

	public function isKickoffInEndzone(): bool
	{
		return $this->kickoffInEndzone;
	}

	public function setKickoffInEndzone(bool $kickoffInEndzone): self
	{
		$this->kickoffInEndzone = $kickoffInEndzone;

		return $this;
	}

	public function isKickoffOutOfBounds(): bool
	{
		return $this->kickoffOutOfBounds;
	}

	public function setKickoffOutOfBounds(bool $kickoffOutOfBounds): self
	{
		$this->kickoffOutOfBounds = $kickoffOutOfBounds;

		return $this;
	}

	public function isKickoffDowned(): bool
	{
		return $this->kickoffDowned;
	}

	public function setKickoffDowned(bool $kickoffDowned): self
	{
		$this->kickoffDowned = $kickoffDowned;

		return $this;
	}

	public function isKickoffFairCatch(): bool
	{
		return $this->kickoffFairCatch;
	}

	public function setKickoffFairCatch(bool $kickoffFairCatch): self
	{
		$this->kickoffFairCatch = $kickoffFairCatch;

		return $this;
	}

	public function isFumbleForced(): bool
	{
		return $this->fumbleForced;
	}

	public function setFumbleForced(bool $fumbleForced): self
	{
		$this->fumbleForced = $fumbleForced;

		return $this;
	}

	public function isFumbleNotForced(): bool
	{
		return $this->fumbleNotForced;
	}

	public function setFumbleNotForced(bool $fumbleNotForced): self
	{
		$this->fumbleNotForced = $fumbleNotForced;

		return $this;
	}

	public function isFumbleOutOfBounds(): bool
	{
		return $this->fumbleOutOfBounds;
	}

	public function setFumbleOutOfBounds(bool $fumbleOutOfBounds): self
	{
		$this->fumbleOutOfBounds = $fumbleOutOfBounds;

		return $this;
	}

	public function isSoloTackle(): bool
	{
		return $this->soloTackle;
	}

	public function setSoloTackle(bool $soloTackle): self
	{
		$this->soloTackle = $soloTackle;

		return $this;
	}

	public function isSafety(): bool
	{
		return $this->safety;
	}

	public function setSafety(bool $safety): self
	{
		$this->safety = $safety;

		return $this;
	}

	public function isPenalty(): bool
	{
		return $this->penalty;
	}

	public function setPenalty(bool $penalty): self
	{
		$this->penalty = $penalty;

		return $this;
	}

	public function isTackledForLoss(): bool
	{
		return $this->tackledForLoss;
	}

	public function setTackledForLoss(bool $tackledForLoss): self
	{
		$this->tackledForLoss = $tackledForLoss;

		return $this;
	}

	public function isFumbleLost(): bool
	{
		return $this->fumbleLost;
	}

	public function setFumbleLost(bool $fumbleLost): self
	{
		$this->fumbleLost = $fumbleLost;

		return $this;
	}

	public function isOwnKickoffRecovery(): bool
	{
		return $this->ownKickoffRecovery;
	}

	public function setOwnKickoffRecovery(bool $ownKickoffRecovery): self
	{
		$this->ownKickoffRecovery = $ownKickoffRecovery;

		return $this;
	}

	public function isOwnKickoffRecoveryTd(): bool
	{
		return $this->ownKickoffRecoveryTd;
	}

	public function setOwnKickoffRecoveryTd(bool $ownKickoffRecoveryTd): self
	{
		$this->ownKickoffRecoveryTd = $ownKickoffRecoveryTd;

		return $this;
	}

	public function isQbHit(): bool
	{
		return $this->qbHit;
	}

	public function setQbHit(bool $qbHit): self
	{
		$this->qbHit = $qbHit;

		return $this;
	}

	public function isRushAttempt(): bool
	{
		return $this->rushAttempt;
	}

	public function setRushAttempt(bool $rushAttempt): self
	{
		$this->rushAttempt = $rushAttempt;

		return $this;
	}

	public function isPassAttempt(): bool
	{
		return $this->passAttempt;
	}

	public function setPassAttempt(bool $passAttempt): self
	{
		$this->passAttempt = $passAttempt;

		return $this;
	}

	public function isSack(): bool
	{
		return $this->sack;
	}

	public function setSack(bool $sack): self
	{
		$this->sack = $sack;

		return $this;
	}

	public function isTouchdown(): bool
	{
		return $this->touchdown;
	}

	public function setTouchdown(bool $touchdown): self
	{
		$this->touchdown = $touchdown;

		return $this;
	}

	public function isPassTouchdown(): bool
	{
		return $this->passTouchdown;
	}

	public function setPassTouchdown(bool $passTouchdown): self
	{
		$this->passTouchdown = $passTouchdown;

		return $this;
	}

	public function isRushTouchdown(): bool
	{
		return $this->rushTouchdown;
	}

	public function setRushTouchdown(bool $rushTouchdown): self
	{
		$this->rushTouchdown = $rushTouchdown;

		return $this;
	}

	public function isReturnTouchdown(): bool
	{
		return $this->returnTouchdown;
	}

	public function setReturnTouchdown(bool $returnTouchdown): self
	{
		$this->returnTouchdown = $returnTouchdown;

		return $this;
	}

	public function isExtraPointAttempt(): bool
	{
		return $this->extraPointAttempt;
	}

	public function setExtraPointAttempt(bool $extraPointAttempt): self
	{
		$this->extraPointAttempt = $extraPointAttempt;

		return $this;
	}

	public function isTwoPointAttempt(): bool
	{
		return $this->twoPointAttempt;
	}

	public function setTwoPointAttempt(bool $twoPointAttempt): self
	{
		$this->twoPointAttempt = $twoPointAttempt;

		return $this;
	}

	public function isFieldGoalAttempt(): bool
	{
		return $this->fieldGoalAttempt;
	}

	public function setFieldGoalAttempt(bool $fieldGoalAttempt): self
	{
		$this->fieldGoalAttempt = $fieldGoalAttempt;

		return $this;
	}

	public function isKickoffAttempt(): bool
	{
		return $this->kickoffAttempt;
	}

	public function setKickoffAttempt(bool $kickoffAttempt): self
	{
		$this->kickoffAttempt = $kickoffAttempt;

		return $this;
	}

	public function isPuntAttempt(): bool
	{
		return $this->puntAttempt;
	}

	public function setPuntAttempt(bool $puntAttempt): self
	{
		$this->puntAttempt = $puntAttempt;

		return $this;
	}

	public function isFumble(): bool
	{
		return $this->fumble;
	}

	public function setFumble(bool $fumble): self
	{
		$this->fumble = $fumble;

		return $this;
	}

	public function isCompletePass(): bool
	{
		return $this->completePass;
	}

	public function setCompletePass(bool $completePass): self
	{
		$this->completePass = $completePass;

		return $this;
	}

	public function isAssistTackle(): bool
	{
		return $this->assistTackle;
	}

	public function setAssistTackle(bool $assistTackle): self
	{
		$this->assistTackle = $assistTackle;

		return $this;
	}

	public function isLateralReception(): bool
	{
		return $this->lateralReception;
	}

	public function setLateralReception(bool $lateralReception): self
	{
		$this->lateralReception = $lateralReception;

		return $this;
	}

	public function isLateralRush(): bool
	{
		return $this->lateralRush;
	}

	public function setLateralRush(bool $lateralRush): self
	{
		$this->lateralRush = $lateralRush;

		return $this;
	}

	public function isLateralReturn(): bool
	{
		return $this->lateralReturn;
	}

	public function setLateralReturn(bool $lateralReturn): self
	{
		$this->lateralReturn = $lateralReturn;

		return $this;
	}

	public function isLateralRecovery(): bool
	{
		return $this->lateralRecovery;
	}

	public function setLateralRecovery(bool $lateralRecovery): self
	{
		$this->lateralRecovery = $lateralRecovery;

		return $this;
	}

	public function isSpecial(): bool
	{
		return $this->special;
	}

	public function setSpecial(bool $special): self
	{
		$this->special = $special;

		return $this;
	}
}
