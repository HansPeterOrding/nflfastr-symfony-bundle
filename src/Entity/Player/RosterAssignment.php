<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Entity\Player;

use DateTime;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Player;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Team;

class RosterAssignment implements RosterAssignmentInterface
{
	protected ?int $id = null;

	protected ?Team $team = null;

	protected ?Player $player = null;

	protected ?int $season = null;

	protected ?string $position = null;

	protected ?string $depthChartPosition = null;

	protected ?int $jerseyNumber = null;

	protected ?string $status = null;

	protected ?DateTime $lastUpdated = null;

	public function getId(): ?int
	{
		return $this->id;
	}

	public function setId(?int $id): self
	{
		$this->id = $id;

		return $this;
	}

	public function getTeam(): ?Team
	{
		return $this->team;
	}

	public function setTeam(?Team $team): self
	{
		$this->team = $team;

		return $this;
	}

	public function getPlayer(): ?Player
	{
		return $this->player;
	}

	public function setPlayer(?Player $player): self
	{
		$this->player = $player;

		return $this;
	}

	public function getSeason(): ?int
	{
		return $this->season;
	}

	public function setSeason(?int $season): self
	{
		$this->season = $season;

		return $this;
	}

	public function getPosition(): ?string
	{
		return $this->position;
	}

	public function setPosition(?string $position): self
	{
		$this->position = $position;

		return $this;
	}

	public function getDepthChartPosition(): ?string
	{
		return $this->depthChartPosition;
	}

	public function setDepthChartPosition(?string $depthChartPosition): self
	{
		$this->depthChartPosition = $depthChartPosition;

		return $this;
	}

	public function getJerseyNumber(): ?int
	{
		return $this->jerseyNumber;
	}

	public function setJerseyNumber(?int $jerseyNumber): self
	{
		$this->jerseyNumber = $jerseyNumber;

		return $this;
	}

	public function getStatus(): ?string
	{
		return $this->status;
	}

	public function setStatus(?string $status): self
	{
		$this->status = $status;

		return $this;
	}

	public function getLastUpdated(): ?DateTime
	{
		return $this->lastUpdated;
	}

	public function setLastUpdated(?DateTime $lastUpdated): self
	{
		$this->lastUpdated = $lastUpdated;

		return $this;
	}

	public function updateLastUpdated()
	{
		$this->lastUpdated = new DateTime();
	}
}
