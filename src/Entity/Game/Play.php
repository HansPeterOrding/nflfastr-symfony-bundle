<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Entity\Game;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game;

class Play implements PlayInterface
{
	protected ?int $id = null;

	protected ?int $playId = null;

	protected bool $playDeleted = false;

	protected ?Game $game = null;

	protected ?string $possessionTeamSideOfField = null;

	protected ?int $yardLine100 = null;

	protected ?int $secondsRemainingQuarter = null;

	protected ?int $secondsRemainingHalf = null;

	protected ?int $secondsRemainingGame = null;

	protected ?string $gameHalf = null;

	protected bool $quarterEnd = false;

	protected ?Drive $drive = null;

	protected bool $scorePlay = false;

	protected ?int $quarter = null;

	protected ?int $down = null;

	protected bool $goalToGo = false;

	protected ?DateTime $time = null;

	protected ?string $description = null;

	protected ?string $type = null;

	protected ?Game\Play\Flags $flags = null;

	protected ?Game\Play\PlayResults $playResults = null;

	protected ?Game\Play\Yards $yards = null;

	/**
	 * @var ArrayCollection|Game\Play\ExpectedPoints[]
	 */
	protected iterable $expectedPoints;

	/**
	 * @var ArrayCollection|Game\Play\WinProbability[]
	 */
	protected iterable $winProbabilities;

	/**
	 * @var ArrayCollection|Game\Play\PlayerAssignment[]
	 */
	protected iterable $playerAssignments;

	/**
	 * @var ArrayCollection|Game\Play\TeamAssignment[]
	 */
	protected iterable $teamAssignments;

	protected array $originalPlayData;

	public function __construct()
	{
		$this->game = new Game();
		$this->drive = new Drive();
		$this->expectedPoints = new ArrayCollection();
		$this->winProbabilities = new ArrayCollection();
		$this->playerAssignments = new ArrayCollection();
		$this->teamAssignments = new ArrayCollection();
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

	public function getPlayId(): ?int
	{
		return $this->playId;
	}

	public function setPlayId(?int $playId): self
	{
		$this->playId = $playId;

		return $this;
	}

	public function isPlayDeleted(): bool
	{
		return $this->playDeleted;
	}

	public function setPlayDeleted(bool $playDeleted): self
	{
		$this->playDeleted = $playDeleted;

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

	public function getPossessionTeamSideOfField(): ?string
	{
		return $this->possessionTeamSideOfField;
	}

	public function setPossessionTeamSideOfField(?string $possessionTeamSideOfField): self
	{
		$this->possessionTeamSideOfField = $possessionTeamSideOfField;

		return $this;
	}

	public function getYardLine100(): ?int
	{
		return $this->yardLine100;
	}

	public function setYardLine100(?int $yardLine100): self
	{
		$this->yardLine100 = $yardLine100;

		return $this;
	}

	public function getSecondsRemainingQuarter(): ?int
	{
		return $this->secondsRemainingQuarter;
	}

	public function setSecondsRemainingQuarter(?int $secondsRemainingQuarter): self
	{
		$this->secondsRemainingQuarter = $secondsRemainingQuarter;

		return $this;
	}

	public function getSecondsRemainingHalf(): ?int
	{
		return $this->secondsRemainingHalf;
	}

	public function setSecondsRemainingHalf(?int $secondsRemainingHalf): self
	{
		$this->secondsRemainingHalf = $secondsRemainingHalf;

		return $this;
	}

	public function getSecondsRemainingGame(): ?int
	{
		return $this->secondsRemainingGame;
	}

	public function setSecondsRemainingGame(?int $secondsRemainingGame): self
	{
		$this->secondsRemainingGame = $secondsRemainingGame;

		return $this;
	}

	public function getGameHalf(): ?string
	{
		return $this->gameHalf;
	}

	public function setGameHalf(?string $gameHalf): self
	{
		$this->gameHalf = $gameHalf;

		return $this;
	}

	public function isQuarterEnd(): bool
	{
		return $this->quarterEnd;
	}

	public function setQuarterEnd(bool $quarterEnd): self
	{
		$this->quarterEnd = $quarterEnd;

		return $this;
	}

	public function getDrive(): ?Drive
	{
		return $this->drive;
	}

	public function setDrive(?Drive $drive): self
	{
		$this->drive = $drive;

		return $this;
	}

	public function isScorePlay(): bool
	{
		return $this->scorePlay;
	}

	public function setScorePlay(bool $scorePlay): self
	{
		$this->scorePlay = $scorePlay;

		return $this;
	}

	public function getQuarter(): ?int
	{
		return $this->quarter;
	}

	public function setQuarter(?int $quarter): self
	{
		$this->quarter = $quarter;

		return $this;
	}

	public function getDown(): ?int
	{
		return $this->down;
	}

	public function setDown(?int $down): self
	{
		$this->down = $down;

		return $this;
	}

	public function isGoalToGo(): bool
	{
		return $this->goalToGo;
	}

	public function setGoalToGo(bool $goalToGo): self
	{
		$this->goalToGo = $goalToGo;

		return $this;
	}

	public function getTime(): ?DateTime
	{
		return $this->time;
	}

	public function setTime(?DateTime $time): self
	{
		$this->time = $time;

		return $this;
	}

	public function getDescription(): ?string
	{
		return $this->description;
	}

	public function setDescription(?string $description): self
	{
		$this->description = $description;

		return $this;
	}

	public function getType(): ?string
	{
		return $this->type;
	}

	public function setType(?string $type): self
	{
		$this->type = $type;

		return $this;
	}

	public function getFlags(): ?Play\Flags
	{
		return $this->flags;
	}

	public function setFlags(?Play\Flags $flags): self
	{
		$this->flags = $flags;

		return $this;
	}

	public function getPlayResults(): ?Play\PlayResults
	{
		return $this->playResults;
	}

	public function setPlayResults(?Play\PlayResults $playResults): self
	{
		$this->playResults = $playResults;

		return $this;
	}

	public function getYards(): ?Play\Yards
	{
		return $this->yards;
	}

	public function setYards(?Play\Yards $yards): self
	{
		$this->yards = $yards;

		return $this;
	}

	/**
	 * @return ArrayCollection|Play\ExpectedPoints[]
	 */
	public function getExpectedPoints(): iterable
	{
		return $this->expectedPoints;
	}

	/**
	 * @param ArrayCollection|Play\ExpectedPoints[] $expectedPoints
	 */
	public function setExpectedPoints(iterable $expectedPoints): self
	{
		$this->expectedPoints = $expectedPoints;

		return $this;
	}

	public function addExpectedPoints(Game\Play\ExpectedPoints $expectedPoints): self
	{
		$expectedPoints->setPlay($this);

		$this->expectedPoints[] = $expectedPoints;

		return $this;
	}

	public function resetExpectedPoints(): self
	{
		$this->expectedPoints->clear();

		return $this;
	}

	/**
	 * @return ArrayCollection|Play\WinProbability[]
	 */
	public function getWinProbabilities(): iterable
	{
		return $this->winProbabilities;
	}

	/**
	 * @param ArrayCollection|Play\WinProbability[] $winProbabilities
	 */
	public function setWinProbabilities(iterable $winProbabilities): self
	{
		$this->winProbabilities = $winProbabilities;

		return $this;
	}

	public function addWinProbability(Game\Play\WinProbability $winProbability): self
	{
		$winProbability->setPlay($this);

		$this->winProbabilities[] = $winProbability;

		return $this;
	}

	public function resetWinProbabilities(): self
	{
		$this->winProbabilities->clear();

		return $this;
	}

	/**
	 * @return ArrayCollection|Play\PlayerAssignment[]
	 */
	public function getPlayerAssignments(): iterable
	{
		return $this->playerAssignments;
	}

	/**
	 * @param ArrayCollection|Play\PlayerAssignment[] $playerAssignments
	 */
	public function setPlayerAssignments(iterable $playerAssignments): self
	{
		$this->playerAssignments = $playerAssignments;

		return $this;
	}

	public function addPlayerAssignment(Game\Play\PlayerAssignment $playerAssignment): self
	{
		$playerAssignment->setPlay($this);

		$this->playerAssignments[] = $playerAssignment;

		return $this;
	}

	public function resetPlayerAssignments(): self
	{
		$this->playerAssignments->clear();

		return $this;
	}

	/**
	 * @return ArrayCollection|Play\TeamAssignment[]
	 */
	public function getTeamAssignments(): iterable
	{
		return $this->teamAssignments;
	}

	/**
	 * @param ArrayCollection|Play\TeamAssignment[] $teamAssignments
	 */
	public function setTeamAssignments(iterable $teamAssignments): self
	{
		$this->teamAssignments = $teamAssignments;

		return $this;
	}

	public function addTeamAssignment(Game\Play\TeamAssignment $teamAssignment): self
	{
		$teamAssignment->setPlay($this);

		$this->teamAssignments[] = $teamAssignment;

		return $this;
	}

	public function resetTeamAssignments(): self
	{
		$this->teamAssignments->clear();

		return $this;
	}

	public function getOriginalPlayData(): array
	{
		return $this->originalPlayData;
	}

	public function setOriginalPlayData(array $originalPlayData): self
	{
		$this->originalPlayData = $originalPlayData;

		return $this;
	}
}
