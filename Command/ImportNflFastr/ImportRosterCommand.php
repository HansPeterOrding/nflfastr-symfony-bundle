<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Command\ImportNflFastr;

use HansPeterOrding\NflFastrSymfonyBundle\Command\AbstractImportNflFastrCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportRosterCommand extends AbstractImportNflFastrCommand
{
	protected static $defaultName = 'nflfastr-symfony:import:roster';

	public function __construct(array $sources, string $name = null)
	{
		parent::__construct($sources, $name);
	}

	protected function configure()
	{
		$this->setDescription('Import full rosters from ' . $this->sources['roster']['baseUrl'] . ' at ' . $this->sources['roster']['path']);
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		return Command::SUCCESS;
	}
}
