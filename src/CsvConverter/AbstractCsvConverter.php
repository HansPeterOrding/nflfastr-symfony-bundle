<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\CsvConverter;

use App\Entity\Player;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Mapping\Entity;

abstract class AbstractCsvConverter
{
	protected ServiceEntityRepository $repository;

	protected ?string $entityClass = null;

	protected function getOrCreateEntity(array $data): Entity
	{
		$entity = $this->repository->findUniqueEntity($data);

		if(!$entity) {
			$entity = new $this->entityClass();
		}

		return $entity;
	}
}
