<?php

declare(strict_types=1);

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Mapping\Entity;
use HansPeterOrding\NflFastrSymfonyBundle\Service\ImportService;

abstract class AbstractNflRepository extends ServiceEntityRepository
{
	public static array $uniqueEntityFields = [];

	public function findUniqueEntity(array $data): ?Entity
	{
		foreach (static::$uniqueEntityFields as $recordColumn => $databaseField) {
			if ($data[$recordColumn] !== ImportService::NOT_AVAILABLE) {
				return $this->findOneBy([
					$databaseField => $data[$recordColumn]
				]);
			}
		}

		return null;
	}
}
