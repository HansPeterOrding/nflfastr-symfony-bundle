<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\CsvConverter;

use HansPeterOrding\NflFastrSymfonyBundle\Entity\Team;

interface TeamConverterInterface extends CsvConverterInterface
{
	public function toEntity(array $record): Team;
}
