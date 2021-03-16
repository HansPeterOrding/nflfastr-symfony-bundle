<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Repository;

interface NflRepositoryInterface
{
	const UNIQUE_ENTITY_FIELD_KEY_COLUMN = 'column';
	const UNIQUE_ENTITY_FIELD_KEY_NOT_EMPTY = 'not_empty';

	public function findUniqueEntity(array $data);
}
