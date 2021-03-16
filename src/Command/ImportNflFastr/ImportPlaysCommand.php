<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Command\ImportNflFastr;

use DateTime;
use HansPeterOrding\NflFastrSymfonyBundle\Command\AbstractImportNflFastrCommand;
use HansPeterOrding\NflFastrSymfonyBundle\Service\ImportService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportPlaysCommand extends AbstractImportNflFastrCommand
{
	const START_YEAR_PLAYS = 1999;

	protected static $defaultName = 'nflfastr-symfony:import:plays';

	public function __construct(
		ImportService $importService,
		string $name = null
	)
	{
		parent::__construct($importService, $name);
	}

	protected function configure()
	{
		$this->setDescription('Import play by play data');
		$this->addArgument(
			'seasons',
			InputArgument::IS_ARRAY,
			'Specific seasons to be imported (separate multiple seasons with a space). If none are given, all available seasons are imported.'
		);
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$this->importService->setOutput($output);
		$this->importService->setInput($input);

		$seasons = $input->getArgument('seasons');
		if(!$seasons) {
			for ($i = static::START_YEAR_PLAYS; $i <= (new DateTime())->format('Y'); $i++) {
				$seasons[] = $i;
			}
		}

		$output->writeln(sprintf('<bg=red;fg=white;options=bold>Starting import for %s seasons.</>', count($seasons)));

		foreach($seasons as $season) {
			$this->importService->importPlayByPlaySeason((int)$season);
		}

		return Command::SUCCESS;
	}
}
