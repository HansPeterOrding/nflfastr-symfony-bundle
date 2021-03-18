<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play\TeamAssignment;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Player\RosterAssignment;

class Team implements TeamInterface
{
	protected ?int $id = null;

	protected ?string $abbreviation = null;

	protected ?string $name = null;

	protected ?string $status = TeamInterface::STATUS_INACTIVE;

	/**
	 * @var ArrayCollection|RosterAssignment[]
	 */
	protected iterable $rosterAssignments;

	/**
	 * @var ArrayCollection|Game[]
	 */
	protected iterable $homeGames;

	/**
	 * @var ArrayCollection|Game[]
	 */
	protected iterable $awayGames;

	/**
	 * @var ArrayCollection|TeamAssignment[]
	 */
	protected iterable $teamAssignments;

	public function __construct()
	{
		$this->rosterAssignments = new ArrayCollection();
		$this->homeGames = new ArrayCollection();
		$this->awayGames = new ArrayCollection();
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

	/**
	 * @return ArrayCollection|RosterAssignment[]
	 */
	public function getRosterAssignments()
	{
		return $this->rosterAssignments;
	}

	/**
	 * @param ArrayCollection|RosterAssignment[] $rosterAssignments
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

	/**
	 * @return ArrayCollection|Game[]
	 */
	public function getHomeGames()
	{
		return $this->homeGames;
	}

	/**
	 * @param ArrayCollection|Game[] $homeGames
	 */
	public function setHomeGames(iterable $homeGames): self
	{
		$this->homeGames = $homeGames;

		return $this;
	}

	/**
	 * @return ArrayCollection|Game[]
	 */
	public function getAwayGames()
	{
		return $this->awayGames;
	}

	/**
	 * @param ArrayCollection|Game[] $awayGames
	 */
	public function setAwayGames(iterable $awayGames): self
	{
		$this->awayGames = $awayGames;

		return $this;
	}

	/**
	 * @return ArrayCollection|TeamAssignment[]
	 */
	public function getTeamAssignments()
	{
		return $this->teamAssignments;
	}

	/**
	 * @param ArrayCollection|TeamAssignment[] $teamAssignments
	 */
	public function setTeamAssignments(iterable $teamAssignments): self
	{
		$this->teamAssignments = $teamAssignments;

		return $this;
	}
}
