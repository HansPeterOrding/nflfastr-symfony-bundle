<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play;

class PlayResults implements PlayResultsInterface
{
	protected ?string $fieldGoalResult = null;

	protected ?string $extraPointResult = null;

	protected ?string $twoPointConversionResult = null;

	protected ?string $replayOrChallengeResult = null;

	protected ?string $seriesResult = null;

	protected ?int $kickDistance = null;

	public function getFieldGoalResult(): ?string
	{
		return $this->fieldGoalResult;
	}

	public function setFieldGoalResult(?string $fieldGoalResult): self
	{
		$this->fieldGoalResult = $fieldGoalResult;

		return $this;
	}

	public function getExtraPointResult(): ?string
	{
		return $this->extraPointResult;
	}

	public function setExtraPointResult(?string $extraPointResult): self
	{
		$this->extraPointResult = $extraPointResult;

		return $this;
	}

	public function getTwoPointConversionResult(): ?string
	{
		return $this->twoPointConversionResult;
	}

	public function setTwoPointConversionResult(?string $twoPointConversionResult): self
	{
		$this->twoPointConversionResult = $twoPointConversionResult;

		return $this;
	}

	public function getReplayOrChallengeResult(): ?string
	{
		return $this->replayOrChallengeResult;
	}

	public function setReplayOrChallengeResult(?string $replayOrChallengeResult): self
	{
		$this->replayOrChallengeResult = $replayOrChallengeResult;

		return $this;
	}

	public function getSeriesResult(): ?string
	{
		return $this->seriesResult;
	}

	public function setSeriesResult(?string $seriesResult): self
	{
		$this->seriesResult = $seriesResult;

		return $this;
	}

	public function getKickDistance(): ?int
	{
		return $this->kickDistance;
	}

	public function setKickDistance(?int $kickDistance): self
	{
		$this->kickDistance = $kickDistance;

		return $this;
	}
}
