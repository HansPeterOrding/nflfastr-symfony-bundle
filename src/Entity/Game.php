<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Drive;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play;

class Game implements GameInterface
{
	protected ?int $id = null;

	protected ?string $gameId = null;

	protected ?string $oldGameId = null;

	protected ?Team $teamHome = null;

	protected ?Team $teamAway = null;

	protected ?string $seasonType = null;

	protected ?int $week = null;

	protected ?DateTime $datetime = null;

	protected ?int $totalScoreHomeTeam = null;

	protected ?int $totalScoreAwayTeam = null;

	/**
	 * @var ArrayCollection|Play[]
	 */
	protected iterable $plays;

	/**
	 * @var ArrayCollection|Drive[]
	 */
	protected iterable $drives;

	public function __construct()
	{
		$this->teamHome = new Team();
		$this->teamAway = new Team();
		$this->plays = new ArrayCollection();
		$this->drives = new ArrayCollection();
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

	public function getGameId(): ?string
	{
		return $this->gameId;
	}

	public function setGameId(?string $gameId): self
	{
		$this->gameId = $gameId;

		return $this;
	}

	public function getOldGameId(): ?string
	{
		return $this->oldGameId;
	}

	public function setOldGameId(?string $oldGameId): self
	{
		$this->oldGameId = $oldGameId;

		return $this;
	}

	public function getTeamHome(): ?Team
	{
		return $this->teamHome;
	}

	public function setTeamHome(?Team $teamHome): self
	{
		$this->teamHome = $teamHome;

		return $this;
	}

	public function getTeamAway(): ?Team
	{
		return $this->teamAway;
	}

	public function setTeamAway(?Team $teamAway): self
	{
		$this->teamAway = $teamAway;

		return $this;
	}

	public function getSeasonType(): ?string
	{
		return $this->seasonType;
	}

	public function setSeasonType(?string $seasonType): self
	{
		$this->seasonType = $seasonType;

		return $this;
	}

	public function getWeek(): ?int
	{
		return $this->week;
	}

	public function setWeek(?int $week): self
	{
		$this->week = $week;

		return $this;
	}

	public function getDatetime(): ?DateTime
	{
		return $this->datetime;
	}

	public function setDatetime(?DateTime $datetime): self
	{
		$this->datetime = $datetime;

		return $this;
	}

	public function getTotalScoreHomeTeam(): ?int
	{
		return $this->totalScoreHomeTeam;
	}

	public function setTotalScoreHomeTeam(?int $totalScoreHomeTeam): self
	{
		$this->totalScoreHomeTeam = $totalScoreHomeTeam;

		return $this;
	}

	public function getTotalScoreAwayTeam(): ?int
	{
		return $this->totalScoreAwayTeam;
	}

	public function setTotalScoreAwayTeam(?int $totalScoreAwayTeam): self
	{
		$this->totalScoreAwayTeam = $totalScoreAwayTeam;

		return $this;
	}

	/**
	 * @return ArrayCollection|Play[]
	 */
	public function getPlays()
	{
		return $this->plays;
	}

	/**
	 * @param ArrayCollection|Play[] $plays
	 */
	public function setPlays(iterable $plays): self
	{
		$this->plays = $plays;

		return $this;
	}

	/**
	 * @return ArrayCollection|Drive[]
	 */
	public function getDrives()
	{
		return $this->drives;
	}

	/**
	 * @param ArrayCollection|Drive[] $drives
	 */
	public function setDrives(iterable $drives): self
	{
		$this->drives = $drives;

		return $this;
	}
}
