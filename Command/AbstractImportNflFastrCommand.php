<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Command;

use Symfony\Component\Console\Command\Command;

abstract class AbstractImportNflFastrCommand extends Command
{
	protected ?iterable $sources = null;

	public function __construct(
		array $sources,
		string $name = null
	)
	{
		parent::__construct($name);

		$this->sources = $sources;
	}
}
