<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Message\PlayByPlayImport;

use DateTime;

class ImportPlayRecordMessage
{
	protected DateTime $created;

	protected int $season;

	protected array $record;

	protected bool $skipUpdates = false;

	public function getCreated(): DateTime
	{
		return $this->created;
	}

	public function setCreated(DateTime $created): self
	{
		$this->created = $created;

		return $this;
	}

	public function getSeason(): int
	{
		return $this->season;
	}

	public function setSeason(int $season): self
	{
		$this->season = $season;

		return $this;
	}

	public function getRecord(): array
	{
		return $this->record;
	}

	public function setRecord(array $record): self
	{
		$this->record = $record;

		return $this;
	}

	public function isSkipUpdates(): bool
	{
		return $this->skipUpdates;
	}

	public function setSkipUpdates(bool $skipUpdates): self
	{
		$this->skipUpdates = $skipUpdates;

		return $this;
	}
}
