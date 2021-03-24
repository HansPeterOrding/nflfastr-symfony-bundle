<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\CsvConverter;

trait AssignmentConverterTrait
{
	private function mapOrderNumber(string $column): int
	{
		if (array_key_exists($column, static::$columnToOrderNumberMapping)) {
			return static::$columnToOrderNumberMapping[$column];
		}

		return 1;
	}

	private function mapYards(string $column, array $record): ?int
	{
		if (array_key_exists($column, static::$columnToYardsMapping)) {
			return static::toInt($record[static::$columnToYardsMapping[$column]]);
		}

		return null;
	}
}
