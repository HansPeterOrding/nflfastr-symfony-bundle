<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\CsvConverter;

use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play;

interface PlayConverterInterface extends CsvConverterInterface
{
	public function toEntity(array $record): Play;
}
