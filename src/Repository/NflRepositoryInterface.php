<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Repository;

use Doctrine\ORM\Mapping\Entity;

interface NflRepositoryInterface
{
	public function findUniqueEntity(array $data): ?Entity;
}
