<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Entity;

use DateTime;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play\PlayerAssignment;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Player\Height;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Player\RosterAssignment;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Player\Weight;

class Player implements PlayerInterface
{
	protected ?int $id = null;

	protected ?string $firstName = null;

	protected ?string $lastName = null;

	protected ?DateTimeImmutable $birthDate = null;

	protected ?Height $height = null;

	protected ?Weight $weight = null;

	protected ?string $college = null;

	protected ?string $highSchool = null;

	protected ?string $gsisId = null;

	protected ?string $espnId = null;

	protected ?string $sportradarId = null;

	protected ?string $yahooId = null;

	protected ?string $rotowireId = null;

	protected ?string $headshotUrl = null;

	protected ?DateTime $lastUpdated = null;

	/**
	 * @var ArrayCollection|RosterAssignment[]
	 */
	protected iterable $rosterAssignments;

	/**
	 * @var ArrayCollection|PlayerAssignment[]
	 */
	protected iterable $playerAssignments;

	public function __construct()
	{
		$this->height = new Height();
		$this->rosterAssignments = new ArrayCollection();
		$this->playerAssignments = new ArrayCollection();
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

	public function getFirstName(): ?string
	{
		return $this->firstName;
	}

	public function setFirstName(?string $firstName): self
	{
		$this->firstName = $firstName;

		return $this;
	}

	public function getLastName(): ?string
	{
		return $this->lastName;
	}

	public function setLastName(?string $lastName): self
	{
		$this->lastName = $lastName;

		return $this;
	}

	public function getBirthDate(): ?DateTimeImmutable
	{
		return $this->birthDate;
	}

	public function setBirthDate(?DateTimeImmutable $birthDate): self
	{
		$this->birthDate = $birthDate;

		return $this;
	}

	public function getHeight(): ?Height
	{
		return $this->height;
	}

	public function setHeight(?Height $height): self
	{
		$this->height = $height;

		return $this;
	}

	public function getWeight(): ?Weight
	{
		return $this->weight;
	}

	public function setWeight(?Weight $weight): self
	{
		$this->weight = $weight;

		return $this;
	}

	public function getCollege(): ?string
	{
		return $this->college;
	}

	public function setCollege(?string $college): self
	{
		$this->college = $college;

		return $this;
	}

	public function getHighSchool(): ?string
	{
		return $this->highSchool;
	}

	public function setHighSchool(?string $highSchool): self
	{
		$this->highSchool = $highSchool;

		return $this;
	}

	public function getGsisId(): ?string
	{
		return $this->gsisId;
	}

	public function setGsisId(?string $gsisId): self
	{
		$this->gsisId = $gsisId;

		return $this;
	}

	public function getEspnId(): ?string
	{
		return $this->espnId;
	}

	public function setEspnId(?string $espnId): self
	{
		$this->espnId = $espnId;

		return $this;
	}

	public function getSportradarId(): ?string
	{
		return $this->sportradarId;
	}

	public function setSportradarId(?string $sportradarId): self
	{
		$this->sportradarId = $sportradarId;

		return $this;
	}

	public function getYahooId(): ?string
	{
		return $this->yahooId;
	}

	public function setYahooId(?string $yahooId): self
	{
		$this->yahooId = $yahooId;

		return $this;
	}

	public function getRotowireId(): ?string
	{
		return $this->rotowireId;
	}

	public function setRotowireId(?string $rotowireId): self
	{
		$this->rotowireId = $rotowireId;

		return $this;
	}

	public function getHeadshotUrl(): ?string
	{
		return $this->headshotUrl;
	}

	public function setHeadshotUrl(?string $headshotUrl): self
	{
		$this->headshotUrl = $headshotUrl;

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

	/**
	 * @return ArrayCollection|RosterAssignment[]
	 */
	public function getRosterAssignments(): iterable
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
	 * @return ArrayCollection|PlayerAssignment[]
	 */
	public function getPlayerAssignments()
	{
		return $this->playerAssignments;
	}

	/**
	 * @param ArrayCollection|PlayerAssignment[] $playerAssignments
	 */
	public function setPlayerAssignments(iterable $playerAssignments): self
	{
		$this->playerAssignments = $playerAssignments;

		return $this;
	}

	public function updateLastUpdated()
	{
		$this->lastUpdated = new DateTime();
	}
}
