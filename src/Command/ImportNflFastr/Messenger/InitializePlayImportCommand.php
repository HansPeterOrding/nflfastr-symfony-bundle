<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Command\ImportNflFastr\Messenger;

use DateTime;
use HansPeterOrding\NflFastrSymfonyBundle\Command\AbstractImportNflFastrCommand;
use HansPeterOrding\NflFastrSymfonyBundle\Service\ImportService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class InitializePlayImportCommand extends AbstractImportNflFastrCommand
{
	const START_YEAR_PLAYS = 1999;

	protected static $defaultName = 'nflfastr-symfony:import:messenger:initialize-play-import';

	public function __construct(
		ImportService $importService,
		string $name = null
	) {
		parent::__construct($importService, $name);
	}

	protected function configure()
	{
		$this->setDescription('Initialize play by play data import for messenger component');
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
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$this->importService->setOutput($output);
		$this->importService->setInput($input);

		$seasons = $input->getArgument('seasons');
		$skipUpdates = $input->getOption('skip-updates');

		if (!$seasons) {
			for ($i = static::START_YEAR_PLAYS; $i <= (new DateTime())->format('Y'); $i++) {
				$seasons[] = $i;
			}
		}

		$output->writeln(sprintf('<bg=red;fg=white;options=bold>Initializing import for %s seasons.</>',
			count($seasons)));

		foreach ($seasons as $season) {
			$this->importService->initializePlayByPlaySeason((int)$season, $skipUpdates);
		}

		return Command::SUCCESS;
	}
}
