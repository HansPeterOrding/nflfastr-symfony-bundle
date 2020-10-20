<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Command\ImportNflFastr;

use DateTime;
use HansPeterOrding\NflFastrSymfonyBundle\Command\AbstractImportNflFastrCommand;
use HansPeterOrding\NflFastrSymfonyBundle\Service\ImportService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportRosterCommand extends AbstractImportNflFastrCommand
{
	const START_YEAR_ROSTERS = 1999;

	protected static $defaultName = 'nflfastr-symfony:import:roster';

	public function __construct(
		ImportService $importService,
		string $name = null
	) {
		parent::__construct($importService, $name);
	}

	protected function configure()
	{
		$this->setDescription('Import full rosters');
		$this->addArgument(
			'seasons',
			InputArgument::IS_ARRAY,
			'Specific seasons to be imported (separate multiple seasons with a space). If none are given, all available seasons are imported.'
		);
		$this->addOption(
			'interactive',
			null,
			InputOption::VALUE_NONE,
			'If this option is set, you will be asked for inputs (e.g. team names). If not, default values will be used.'
		);
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$this->importService->setOutput($output);
		$this->importService->setInput($input);

		$seasons = $input->getArgument('seasons');
		if (!$seasons) {
			for ($i = static::START_YEAR_ROSTERS; $i <= (new DateTime())->format('Y'); $i++) {
				$seasons[] = $i;
			}
		}
		$interactive = $input->getOption('interactive');

		$output->writeln(sprintf('<bg=red;fg=white;options=bold>Starting import for %s seasons.</>', count($seasons)));

		foreach ($seasons as $season) {
			$this->importService->importRosterSeason((int)$season, $interactive);
		}

		return Command::SUCCESS;
	}
}
