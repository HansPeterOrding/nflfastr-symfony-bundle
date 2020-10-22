<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Entity;

use DateTime;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Player\Height;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Player\Weight;

/**
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class Player implements PlayerInterface
{
	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	protected ?int $id = null;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	protected ?string $firstName = null;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	protected ?string $lastName = null;

	/**
	 * @ORM\Column(type="datetime_immutable", nullable=true)
	 */
	protected ?DateTimeImmutable $birthDate = null;

	/**
	 * @ORM\Embedded(
	 *     class="HansPeterOrding\NflFastrSymfonyBundle\Entity\Player\Height",
	 *     columnPrefix="height_"
	 * )
	 */
	protected ?Height $height = null;

	/**
	 * @ORM\Embedded(
	 *     class="HansPeterOrding\NflFastrSymfonyBundle\Entity\Player\Weight",
	 *     columnPrefix="weight_"
	 * )
	 */
	protected ?Weight $weight = null;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	protected ?string $college = null;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	protected ?string $highSchool = null;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected ?string $gsisId = null;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected ?string $espnId = null;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected ?string $sportradarId = null;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected ?string $yahooId = null;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected ?string $rotowireId = null;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	protected ?string $headshotUrl = null;

	/**
	 * @ORM\Column(type="datetime")
	 */
	protected ?DateTime $lastUpdated = null;

	/**
	 * @var RosterAssignment[]
	 *
	 * @ORM\OneToMany(targetEntity="HansPeterOrding\NflFastrSymfonyBundle\Entity\RosterAssignment", mappedBy="player")
	 */
	protected iterable $rosterAssignments;

	public function __construct()
	{
		$this->height = new Height();
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
	 * @return RosterAssignment[]
	 */
	public function getRosterAssignments(): iterable
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

	/**
	 * @ORM\PrePersist()
	 * @ORM\PreUpdate()
	 */
	public function updateLastUpdated()
	{
		$this->lastUpdated = new DateTime();
	}
}
