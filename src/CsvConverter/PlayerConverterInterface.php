<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\CsvConverter;

use HansPeterOrding\NflFastrSymfonyBundle\Entity\Player;

interface PlayerConverterInterface extends CsvConverterInterface
{
	public function toEntity(array $record): Player;
}
