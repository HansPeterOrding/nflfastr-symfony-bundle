<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\CsvConverter;

use DateTimeImmutable;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Player;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Player\Height;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Player\Weight;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\PlayerInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Repository\PlayerRepository;

/**
 * @method getOrCreateEntity(array $data) : Player
 */
class PlayerConverter extends AbstractCsvConverter implements PlayerConverterInterface
{
	private static array $birthDateSourceFormats = [
		'Y-m-d',
		'm/d/Y'
	];

	private static array $heightParsingPatterns = [
		'#^(?<feet>\d+)\'(?<inches>\d+)"$#',
		'#^(?<feet>\d+)-(?<inches>\d+)$#'
	];

	public function __construct(
		PlayerRepository $repository
	)
	{
		$this->repository = $repository;
	}

	public function defineEntityClass()
	{
		$this->entityClass = Player::class;
	}

	public function toEntity(array $record): Player
	{
		$player = $this->getOrCreateEntity($record);

		$player->setFirstName($record[PlayerInterface::COLUMN_PLAYER_FIRSTNAME]);
		$player->setLastName($record[PlayerInterface::COLUMN_PLAYER_LASTNAME]);
		$player->setBirthDate(static::buildBirthDate($record[PlayerInterface::COLUMN_PLAYER_BIRTHDATE]));

		$player->setHeight(
			$this->buildHeight($record[PlayerInterface::COLUMN_PLAYER_HEIGHT])
		);
		$player->setWeight(
			$this->buildWeight($record[PlayerInterface::COLUMN_PLAYER_WEIGHT])
		);
		$player->setCollege($record[PlayerInterface::COLUMN_PLAYER_COLLEGE]);
		$player->setHighSchool($record[PlayerInterface::COLUMN_PLAYER_HIGHSCHOOL]);

		if ($record[PlayerInterface::COLUMN_PLAYER_GSIS_ID] !== CsvConverterInterface::FIELD_VALUE_NOT_AVAILABLE) {
			$player->setGsisId($record[PlayerInterface::COLUMN_PLAYER_GSIS_ID]);
		}
		if ($record[PlayerInterface::COLUMN_PLAYER_ESPN_ID] !== CsvConverterInterface::FIELD_VALUE_NOT_AVAILABLE) {
			$player->setEspnId($record[PlayerInterface::COLUMN_PLAYER_ESPN_ID]);
		}
		if ($record[PlayerInterface::COLUMN_PLAYER_SPORTRADAR_ID] !== CsvConverterInterface::FIELD_VALUE_NOT_AVAILABLE) {
			$player->setSportradarId($record[PlayerInterface::COLUMN_PLAYER_SPORTRADAR_ID]);
		}
		if ($record[PlayerInterface::COLUMN_PLAYER_YAHOO_ID] !== CsvConverterInterface::FIELD_VALUE_NOT_AVAILABLE) {
			$player->setYahooId($record[PlayerInterface::COLUMN_PLAYER_YAHOO_ID]);
		}
		if ($record[PlayerInterface::COLUMN_PLAYER_ROTOWIRE_ID] !== CsvConverterInterface::FIELD_VALUE_NOT_AVAILABLE) {
			$player->setRotowireId($record[PlayerInterface::COLUMN_PLAYER_ROTOWIRE_ID]);
		}

		$player->setHeadshotUrl($record[PlayerInterface::COLUMN_PLAYER_HEADSHOT_URL]);

		return $player;
	}

	public static function buildBirthDate(string $birthDateString): ?DateTimeImmutable
	{
		if ($birthDateString === CsvConverterInterface::FIELD_VALUE_NOT_AVAILABLE) {
			return null;
		}

		foreach (static::$birthDateSourceFormats as $birthDateSourceFormat) {
			$birthDate = DateTimeImmutable::createFromFormat($birthDateSourceFormat, $birthDateString);
			if ($birthDate) {
				return $birthDate;
			}
		}

		return null;
	}

	private function buildHeight(string $heightString): ?Height
	{
		$result = null;

		if ($heightString === CsvConverterInterface::FIELD_VALUE_NOT_AVAILABLE) {
			return null;
		}

		foreach (static::$heightParsingPatterns as $heightParsingPattern) {
			preg_match($heightParsingPattern, $heightString, $result);
			if (array_key_exists('feet', $result) || array_key_exists('inches', $result)) {
				break;
			}
		}

		$height = new Height();
		$height->setFeet((int)$result['feet']);
		$height->setInches((int)$result['inches']);
		$height->setCm($height->calculateCm());

		return $height;
	}

	private function buildWeight(string $weightString): Weight
	{
		$weight = new Weight();

		$weight->setPounds((int)$weightString);
		$weight->setKilograms($weight->calculateKilograms());

		return $weight;
	}
}
