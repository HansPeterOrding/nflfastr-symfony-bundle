<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play;

class Yards implements YardsInterface
{
	protected ?int $gained = null;

	protected ?int $net = null;

	protected ?int $toGo = null;

	protected ?int $air = null;

	protected ?int $afterCatch = null;

	protected ?int $passing = null;

	protected ?int $receiving = null;

	protected ?int $rushing = null;

	protected ?int $lateralReceiving = null;

	protected ?int $lateralRushing = null;

	protected ?int $fumbleRecovery1 = null;

	protected ?int $funbleRecovery2 = null;

	protected ?int $return = null;

	protected ?int $penalty = null;

	protected ?int $drivePenalized = null;

	public function getGained(): ?int
	{
		return $this->gained;
	}

	public function setGained(?int $gained): self
	{
		$this->gained = $gained;

		return $this;
	}

	public function getNet(): ?int
	{
		return $this->net;
	}

	public function setNet(?int $net): self
	{
		$this->net = $net;

		return $this;
	}

	public function getToGo(): ?int
	{
		return $this->toGo;
	}

	public function setToGo(?int $toGo): self
	{
		$this->toGo = $toGo;

		return $this;
	}

	public function getAir(): ?int
	{
		return $this->air;
	}

	public function setAir(?int $air): self
	{
		$this->air = $air;

		return $this;
	}

	public function getAfterCatch(): ?int
	{
		return $this->afterCatch;
	}

	public function setAfterCatch(?int $afterCatch): self
	{
		$this->afterCatch = $afterCatch;

		return $this;
	}

	public function getPassing(): ?int
	{
		return $this->passing;
	}

	public function setPassing(?int $passing): self
	{
		$this->passing = $passing;

		return $this;
	}

	public function getReceiving(): ?int
	{
		return $this->receiving;
	}

	public function setReceiving(?int $receiving): self
	{
		$this->receiving = $receiving;

		return $this;
	}

	public function getRushing(): ?int
	{
		return $this->rushing;
	}

	public function setRushing(?int $rushing): self
	{
		$this->rushing = $rushing;

		return $this;
	}

	public function getLateralReceiving(): ?int
	{
		return $this->lateralReceiving;
	}

	public function setLateralReceiving(?int $lateralReceiving): self
	{
		$this->lateralReceiving = $lateralReceiving;

		return $this;
	}

	public function getLateralRushing(): ?int
	{
		return $this->lateralRushing;
	}

	public function setLateralRushing(?int $lateralRushing): self
	{
		$this->lateralRushing = $lateralRushing;

		return $this;
	}

	public function getFumbleRecovery1(): ?int
	{
		return $this->fumbleRecovery1;
	}

	public function setFumbleRecovery1(?int $fumbleRecovery1): self
	{
		$this->fumbleRecovery1 = $fumbleRecovery1;

		return $this;
	}

	public function getFunbleRecovery2(): ?int
	{
		return $this->funbleRecovery2;
	}

	public function setFunbleRecovery2(?int $funbleRecovery2): self
	{
		$this->funbleRecovery2 = $funbleRecovery2;

		return $this;
	}

	public function getReturn(): ?int
	{
		return $this->return;
	}

	public function setReturn(?int $return): self
	{
		$this->return = $return;

		return $this;
	}

	public function getPenalty(): ?int
	{
		return $this->penalty;
	}

	public function setPenalty(?int $penalty): self
	{
		$this->penalty = $penalty;

		return $this;
	}

	public function getDrivePenalized(): ?int
	{
		return $this->drivePenalized;
	}

	public function setDrivePenalized(?int $drivePenalized): self
	{
		$this->drivePenalized = $drivePenalized;

		return $this;
	}
}
