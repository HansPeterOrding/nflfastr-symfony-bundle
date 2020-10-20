<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Entity\Player;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class Height
{
	const CONVERSION_FACTOR_FEET = 30.48;
	const CONVERSION_FACTOR_INCHES = 2.54;

	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected ?int $feet = null;

	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected ?int $inches = null;

	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected ?int $cm = null;

	public function getFeet(): ?int
	{
		return $this->feet;
	}

	public function setFeet(?int $feet): self
	{
		$this->feet = $feet;

		return $this;
	}

	public function getInches(): ?int
	{
		return $this->inches;
	}

	public function setInches(?int $inches): self
	{
		$this->inches = $inches;

		return $this;
	}

	public function getCm(): ?int
	{
		return $this->cm;
	}

	public function setCm(?int $cm): self
	{
		$this->cm = $cm;

		return $this;
	}

	public function calculateCm(): int
	{
		return (int)round($this->feet * static::CONVERSION_FACTOR_FEET + $this->inches * static::CONVERSION_FACTOR_INCHES,
			0);
	}

	public function calculateInches(): int
	{
		return (int)round(($this->cm % static::CONVERSION_FACTOR_FEET) / static::CONVERSION_FACTOR_INCHES, 2);
	}

	public function calculateFeet(): int
	{
		return (int)floor($this->cm / static::CONVERSION_FACTOR_FEET);
	}
}
