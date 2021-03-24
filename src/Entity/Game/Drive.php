<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Entity\Game;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game;

class Drive implements DriveInterface
{
	protected ?int $id = null;

	protected ?Game $game = null;

	protected ?int $number = null;

	protected ?DateTime $realStartTime = null;

	protected ?int $playCount = null;

	protected ?DateTime $timeOfPosession = null;

	protected ?int $firstDowns = null;

	protected bool $insideTwenty = false;

	protected bool $endedWithScore = false;

	protected ?int $quarterStart = null;

	protected ?int $quarterEnd = null;

	protected ?int $yardsPenalized = null;

	protected ?string $startTransition = null;

	protected ?string $endTransition = null;

	protected ?DateTime $gameClockStart = null;

	protected ?DateTime $gameClockEnd = null;

	protected ?string $startYardLine = null;

	protected ?string $endYardLine = null;

	/**
	 * @var ArrayCollection|Play[]
	 */
	protected iterable $plays;

	public function __construct()
	{
		$this->game = new Game();
		$this->plays = new ArrayCollection();
	}

	public function getId(): ?int
	{
		return $this->id;
	}

	public function setId(?int $id): self
	{
		$this->id = $id;

		return $this;
	}

	public function getGame(): ?Game
	{
		return $this->game;
	}

	public function setGame(?Game $game): self
	{
		$this->game = $game;

		return $this;
	}

	public function getNumber(): ?int
	{
		return $this->number;
	}

	public function setNumber(?int $number): self
	{
		$this->number = $number;

		return $this;
	}

	public function getRealStartTime(): ?DateTime
	{
		return $this->realStartTime;
	}

	public function setRealStartTime(?DateTime $realStartTime): self
	{
		$this->realStartTime = $realStartTime;

		return $this;
	}

	public function getPlayCount(): ?int
	{
		return $this->playCount;
	}

	public function setPlayCount(?int $playCount): self
	{
		$this->playCount = $playCount;

		return $this;
	}

	public function getTimeOfPosession(): ?DateTime
	{
		return $this->timeOfPosession;
	}

	public function setTimeOfPosession(?DateTime $timeOfPosession): self
	{
		$this->timeOfPosession = $timeOfPosession;

		return $this;
	}

	public function getFirstDowns(): ?int
	{
		return $this->firstDowns;
	}

	public function setFirstDowns(?int $firstDowns): self
	{
		$this->firstDowns = $firstDowns;

		return $this;
	}

	public function isInsideTwenty(): bool
	{
		return $this->insideTwenty;
	}

	public function setInsideTwenty(bool $insideTwenty): self
	{
		$this->insideTwenty = $insideTwenty;

		return $this;
	}

	public function isEndedWithScore(): bool
	{
		return $this->endedWithScore;
	}

	public function setEndedWithScore(bool $endedWithScore): self
	{
		$this->endedWithScore = $endedWithScore;

		return $this;
	}

	public function getQuarterStart(): ?int
	{
		return $this->quarterStart;
	}

	public function setQuarterStart(?int $quarterStart): self
	{
		$this->quarterStart = $quarterStart;

		return $this;
	}

	public function getQuarterEnd(): ?int
	{
		return $this->quarterEnd;
	}

	public function setQuarterEnd(?int $quarterEnd): self
	{
		$this->quarterEnd = $quarterEnd;

		return $this;
	}

	public function getYardsPenalized(): ?int
	{
		return $this->yardsPenalized;
	}

	public function setYardsPenalized(?int $yardsPenalized): self
	{
		$this->yardsPenalized = $yardsPenalized;

		return $this;
	}

	public function getStartTransition(): ?string
	{
		return $this->startTransition;
	}

	public function setStartTransition(?string $startTransition): self
	{
		$this->startTransition = $startTransition;

		return $this;
	}

	public function getEndTransition(): ?string
	{
		return $this->endTransition;
	}

	public function setEndTransition(?string $endTransition): self
	{
		$this->endTransition = $endTransition;

		return $this;
	}

	public function getGameClockStart(): ?DateTime
	{
		return $this->gameClockStart;
	}

	public function setGameClockStart(?DateTime $gameClockStart): self
	{
		$this->gameClockStart = $gameClockStart;

		return $this;
	}

	public function getGameClockEnd(): ?DateTime
	{
		return $this->gameClockEnd;
	}

	public function setGameClockEnd(?DateTime $gameClockEnd): self
	{
		$this->gameClockEnd = $gameClockEnd;

		return $this;
	}

	public function getStartYardLine(): ?string
	{
		return $this->startYardLine;
	}

	public function setStartYardLine(?string $startYardLine): self
	{
		$this->startYardLine = $startYardLine;

		return $this;
	}

	public function getEndYardLine(): ?string
	{
		return $this->endYardLine;
	}

	public function setEndYardLine(?string $endYardLine): self
	{
		$this->endYardLine = $endYardLine;

		return $this;
	}

	public function getPlays()
	{
		return $this->plays;
	}

	public function setPlays($plays): self
	{
		$this->plays = $plays;

		return $this;
	}
}
