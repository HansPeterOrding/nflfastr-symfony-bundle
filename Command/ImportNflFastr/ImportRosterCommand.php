<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Command\ImportNflFastr;

use HansPeterOrding\NflFastrSymfonyBundle\Command\AbstractImportNflFastrCommand;
use HansPeterOrding\NflFastrSymfonyBundle\Service\ImportService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportRosterCommand extends AbstractImportNflFastrCommand
{
	protected static $defaultName = 'nflfastr-symfony:import:roster';

	public function __construct(
		ImportService $importService,
		string $name = null
	)
	{
		parent::__construct($importService, $name);
	}

	protected function configure()
	{
		$this->setDescription('Import full rosters');
		$this->addArgument(
			'years',
			InputArgument::IS_ARRAY,
			'Specific years to be imported (separate multiple names with a space). If none are given, all available years are imported.'
		);
		$this->addOption(
			'replace',
			null,
			InputOption::VALUE_NONE,
			'This option replaces all rosters of all given years. Otherwise rosters are extended but not overwritten.'
		);
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$years = $input->getArgument('years');
		$replace = $input->getOption('replace');

		foreach($years as $year) {
			if($replace) {
				$this->importService->truncateRosterYear((int)$year);
			}
			$this->importService->importRosterYear((int)$year);
		}

		return Command::SUCCESS;
	}
}
