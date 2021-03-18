<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\CsvConverter;

use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Drive;

interface DriveConverterInterface extends CsvConverterInterface
{
	public function toEntity(array $record): Drive;
}
