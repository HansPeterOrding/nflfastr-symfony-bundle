<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use HansPeterOrding\NflFastrSymfonyBundle\CsvConverter\CsvConverterInterface;

abstract class AbstractNflRepository extends ServiceEntityRepository implements NflRepositoryInterface
{
	protected static array $uniqueEntityFields = [];

	public function findUniqueEntity(array $data)
	{
		foreach (static::$uniqueEntityFields as $recordColumn => $databaseField) {
			if ($data[$recordColumn] !== CsvConverterInterface::FIELD_VALUE_NOT_AVAILABLE) {
				return $this->findOneBy([
					$databaseField => $data[$recordColumn]
				]);
			}
		}

		return null;
	}
}
