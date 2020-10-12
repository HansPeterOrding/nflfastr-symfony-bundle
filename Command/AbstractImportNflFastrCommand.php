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
		$this->sources = $sources;

		parent::__construct($name);
	}
}
