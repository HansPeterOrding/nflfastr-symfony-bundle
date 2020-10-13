<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Command;

use HansPeterOrding\NflFastrSymfonyBundle\Service\ImportService;
use Symfony\Component\Console\Command\Command;

abstract class AbstractImportNflFastrCommand extends Command
{
	protected ?ImportService $importService = null;

	public function __construct(
		ImportService $importService,
		string $name = null
	) {
		$this->importService = $importService;

		parent::__construct($name);
	}
}
