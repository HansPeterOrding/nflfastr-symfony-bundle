<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Tests;

use HansPeterOrding\NflFastrSymfonyBundle\Service\ImportService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ImportServiceTest extends WebTestCase
{
	public function testServiceClass()
	{
		self::bootKernel();

		$container = self::$kernel->getContainer();

		$importService = $container->get('nfl_fastr_symfony.import_service');

		$this->assertInstanceOf(ImportService::class, $importService);
	}
}
