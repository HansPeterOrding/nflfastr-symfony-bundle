<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Service;

class ImportService
{
	private ?iterable $sources = [];

	public function __construct(
		array $sources
	)
	{
		$this->sources = $sources;
	}

	public function truncateRosterYear(int $year)
	{

	}

	public function importRosterYear(int $year)
	{
		/**
		 * Read roster data from source
		 * Create or update teams
		 * Create or update players
		 * Create or update roster assignments
		 */
	}
}
