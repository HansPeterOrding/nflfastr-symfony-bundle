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

class ImportPlaysCommand extends AbstractImportNflFastrCommand
{
	const START_YEAR_PLAYS = 1999;

	protected static $defaultName = 'nflfastr-symfony:import:plays';

	public function __construct(
		ImportService $importService,
		string $name = null
	) {
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
		$this->addOption(
			'skip-updates',
			's',
			InputOption::VALUE_NONE,
			'Pass this option to skip already imported plays. Otherwise imported plays will be updated with new data.'
		);
		$this->addOption(
			'limit',
			'l',
			InputOption::VALUE_OPTIONAL,
			'Pass the number of plays to limit the run to. If you also set skip-updates, only updated plays count to the limit.',
			false
		);
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$this->importService->setOutput($output);
		$this->importService->setInput($input);

		$seasons = $input->getArgument('seasons');
		$skipUpdates = $input->getOption('skip-updates');
		$limit = $input->getOption('limit');

		if (!$seasons) {
			for ($i = static::START_YEAR_PLAYS; $i <= (new DateTime())->format('Y'); $i++) {
				$seasons[] = $i;
			}
		}

		$output->writeln(sprintf('<bg=red;fg=white;options=bold>Starting import for %s seasons.</>', count($seasons)));
		$counter = 0;

		foreach ($seasons as $season) {
			try {
				$counter = $this->importService->importPlayByPlaySeason((int)$season, $counter, $skipUpdates, $limit?(int)$limit:false);
				if($counter >= $limit) {
					break;
				}
			} catch (\Throwable $e) {
				dump($e);
				die();
			}
		}

		return Command::SUCCESS;
	}
}
