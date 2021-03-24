<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play;

use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play;

class ExpectedPoints implements ExpectedPointsInterface
{
	protected ?int $id = null;

	protected ?float $points = null;

	protected ?string $teamType = null;

	protected bool $added = false;

	protected ?string $type = null;

	protected ?string $airOrYac = null;

	protected ?Play $play = null;

	public function __construct()
	{
		$this->play = new Play();
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

	public function getPoints(): ?float
	{
		return $this->points;
	}

	public function setPoints(?float $points): self
	{
		$this->points = $points;

		return $this;
	}

	public function getTeamType(): ?string
	{
		return $this->teamType;
	}

	public function setTeamType(?string $teamType): self
	{
		$this->teamType = $teamType;

		return $this;
	}

	public function isAdded(): bool
	{
		return $this->added;
	}

	public function setAdded(bool $added): self
	{
		$this->added = $added;

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

	public function getAirOrYac(): ?string
	{
		return $this->airOrYac;
	}

	public function setAirOrYac(?string $airOrYac): self
	{
		$this->airOrYac = $airOrYac;

		return $this;
	}

	public function getPlay(): ?Play
	{
		return $this->play;
	}

	public function setPlay(?Play $play): self
	{
		$this->play = $play;

		return $this;
	}
}
