<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Tests\Command\ImportNflFastr;

use HansPeterOrding\NflFastrSymfonyBundle\Command\ImportNflFastr\ImportRosterCommand;
use HansPeterOrding\NflFastrSymfonyBundle\Service\ImportService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;

class ImportRosterCommandTest extends TestCase
{
	/**
	 * @todo: rename as soon as a real test case is clear.
	 */
	public function testCommand()
	{
		/**
		 * @todo: See https://github.com/symfony/maker-bundle/blob/v1.21.1/tests/Command/MakerCommandTest.php for howto
		 */
		$importService = $this->createMock(ImportService::class);

		$command = new ImportRosterCommand($importService);

		$tester = new CommandTester($command);
		$tester->execute([]);
	}
}
