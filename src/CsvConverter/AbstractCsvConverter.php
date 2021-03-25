<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\CsvConverter;

use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

abstract class AbstractCsvConverter implements CsvConverterInterface
{
	protected static array $boolTrue = [
		true,
		1,
		"1"
	];

	private static array $dateSourceFormats = [
		'Y-m-d',
		'm/d/Y'
	];

	private static array $timeSourceFormats = [
		'H:i',
		'H:i:s'
	];

	private static array $dateTimeSourceFormats = [
		'Y-m-d H:i',
		'Y-m-d H:i:s',
		'm/d/Y H:i',
		'm/d/Y H:i:s'
	];

	protected ServiceEntityRepository $repository;

	protected ?string $entityClass = null;

	protected function getOrCreateEntity(array $data)
	{
		$this->defineEntityClass();

		$entity = $this->repository->findUniqueEntity($data);

		if (!$entity) {
			$entity = new $this->entityClass();
		}

		return $entity;
	}

	protected static function toBool($value): bool
	{
		if (in_array($value, static::$boolTrue)) {
			return true;
		}

		return false;
	}

	public static function toString(string $value, $nullable = true): ?string
	{
		if ($value === CsvConverterInterface::FIELD_VALUE_NOT_AVAILABLE) {
			return $nullable ? null : '';
		}

		return (string)$value;
	}

	public static function toInt(string $value, $nullable = true): ?int
	{
		if ($value === CsvConverterInterface::FIELD_VALUE_NOT_AVAILABLE) {
			return $nullable ? null : 0;
		}

		return (int)$value;
	}

	protected static function toFloat(string $value, $nullable = true): ?float
	{
		if ($value === CsvConverterInterface::FIELD_VALUE_NOT_AVAILABLE) {
			return $nullable ? null : 0;
		}

		return floatval($value);
	}

	public static function toDate(string $dateString): ?DateTime
	{
		if ($dateString === CsvConverterInterface::FIELD_VALUE_NOT_AVAILABLE) {
			return null;
		}

		foreach (static::$dateSourceFormats as $dateSourceFormat) {
			$dateTime = DateTime::createFromFormat($dateSourceFormat, $dateString);
			$dateTime->setTime(0, 0);

			if ($dateTime) {
				return $dateTime;
			}
		}

		return null;
	}

	protected static function toTime(string $timeString): ?DateTime
	{
		if ($timeString === CsvConverterInterface::FIELD_VALUE_NOT_AVAILABLE || $timeString === "") {
			return null;
		}

		foreach (static::$timeSourceFormats as $timeSourceFormat) {
			$dateTime = DateTime::createFromFormat($timeSourceFormat, $timeString);

			if ($dateTime) {
				return $dateTime;
			}
		}

		return null;
	}

	protected static function toDateTime(string $dateTimeString): ?DateTime
	{
		if ($dateTimeString === CsvConverterInterface::FIELD_VALUE_NOT_AVAILABLE) {
			return null;
		}

		foreach (static::$dateTimeSourceFormats as $dateTimeSourceFormat) {
			$dateTime = DateTime::createFromFormat($dateTimeSourceFormat, $dateTimeString);

			if ($dateTime) {
				return $dateTime;
			}
		}

		return null;
	}

	protected static function combineDateAndTime(string $dateString, string $timeString): ?DateTime
	{
		if (null === ($date = static::toDate($dateString))) {
			return null;
		}
		if (null === ($time = static::toTime($timeString))) {
			return $date;
		}

		$date->setTime(
			(int)$time->format('G'),
			(int)$time->format('m'),
			(int)$time->format('s')
		);

		return $date;
	}
}
