<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\CsvConverter;

use HansPeterOrding\NflFastrSymfonyBundle\Entity\RosterAssignment;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\RosterAssignmentInterface;

interface RosterAssignmentConverterInterface extends CsvConverterInterface
{
	public function toEntity(array $record): RosterAssignment;
}
