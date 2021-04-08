<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\CsvConverter;

use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play\PlayResults;

interface PlayResultsConverterInterface extends CsvConverterInterface
{
	public function toEntity(array $record): PlayResults;
}
