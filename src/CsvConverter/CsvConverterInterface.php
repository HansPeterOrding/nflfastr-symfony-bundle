<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\CsvConverter;

interface CsvConverterInterface
{
	public const FIELD_VALUE_NOT_AVAILABLE = 'NA';

	public function defineEntityClass();
}
