<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Message\RosterImport;

use DateTime;

class ImportRosterRecordMessage
{
	protected DateTime $created;

	protected bool $interactive = false;

	protected array $record;

	public function getCreated(): DateTime
	{
		return $this->created;
	}

	public function setCreated(DateTime $created): self
	{
		$this->created = $created;

		return $this;
	}

	public function isInteractive(): bool
	{
		return $this->interactive;
	}

	public function setInteractive(bool $interactive): self
	{
		$this->interactive = $interactive;

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
}
