<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\CsvConverter;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

abstract class AbstractCsvConverter implements CsvConverterInterface
{
	protected ServiceEntityRepository $repository;

	protected ?string $entityClass = null;

	protected function getOrCreateEntity(array $data)
	{
		$this->defineEntityClass();

		$entity = $this->repository->findUniqueEntity($data);

		if(!$entity) {
			$entity = new $this->entityClass();
		}

		return $entity;
	}
}
