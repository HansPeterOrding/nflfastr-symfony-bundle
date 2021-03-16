<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Entity\Player;

use Doctrine\ORM\Mapping as ORM;

class Weight
{
	const CONVERSION_FACTOR = 0.45359237;

	protected ?int $pounds = null;

	protected ?int $kilograms = null;

	public function getPounds(): ?int
	{
		return $this->pounds;
	}

	public function setPounds(?int $pounds): self
	{
		$this->pounds = $pounds;

		return $this;
	}

	public function getKilograms(): ?int
	{
		return $this->kilograms;
	}

	public function setKilograms(?int $kilograms): self
	{
		$this->kilograms = $kilograms;

		return $this;
	}

	public function calculateKilograms(): ?int
	{
		if (null === $this->pounds) {
			return null;
		}

		return (int)round($this->pounds * static::CONVERSION_FACTOR, 0);
	}

	public function calculatePounds(): ?int
	{
		if (null === $this->kilograms) {
			return null;
		}
		
		return (int)round($this->kilograms / static::CONVERSION_FACTOR, 2);
	}
}
