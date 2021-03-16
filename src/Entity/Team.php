<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Player\RosterAssignment;

class Team implements TeamInterface
{
	protected ?int $id = null;

	protected ?string $abbreviation = null;

	protected ?string $name = null;

	protected ?string $status = TeamInterface::STATUS_INACTIVE;

	protected iterable $rosterAssignments;

	public function __construct()
	{
		$this->rosterAssignments = new ArrayCollection();
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

	public function getAbbreviation(): ?string
	{
		return $this->abbreviation;
	}

	public function setAbbreviation(?string $abbreviation): self
	{
		$this->abbreviation = $abbreviation;

		return $this;
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function setName(?string $name): self
	{
		$this->name = $name;

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

	public function getRosterAssignments()
	{
		return $this->rosterAssignments;
	}

	/**
	 * @param RosterAssignment[] $rosterAssignments
	 */
	public function setRosterAssignments(iterable $rosterAssignments): self
	{
		$this->rosterAssignments = $rosterAssignments;

		return $this;
	}

	public function addRosterAssignment(RosterAssignment $rosterAssignment): self
	{
		$this->rosterAssignments[] = $rosterAssignment;

		return $this;
	}

	public function removeRosterAssignment(RosterAssignment $rosterAssignment): self
	{
		$this->rosterAssignments->remove($rosterAssignment->getId());

		return $this;
	}
}
