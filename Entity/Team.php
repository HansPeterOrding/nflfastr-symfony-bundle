<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class Team
{
	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	protected ?int $id = null;

	/**
	 * @ORM\Column(type="string", length=3, nullable=false)
	 */
	protected ?string $abbreviation = null;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected ?string $name = null;

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
}
