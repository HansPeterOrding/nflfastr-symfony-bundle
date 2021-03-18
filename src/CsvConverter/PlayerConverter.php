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
	) {
		$this->repository = $repository;
	}

	public function defineEntityClass()
	{
		$this->entityClass = Player::class;
	}

	public function toEntity(array $record): Player
	{
		$player = $this->getOrCreateEntity($record);

		$player->setFirstName(static::toString($record[PlayerInterface::COLUMN_PLAYER_FIRSTNAME]));
		$player->setLastName(static::toString($record[PlayerInterface::COLUMN_PLAYER_LASTNAME]));
		$player->setBirthDate(static::toDate($record[PlayerInterface::COLUMN_PLAYER_BIRTHDATE]));

		$player->setHeight(
			$this->buildHeight($record[PlayerInterface::COLUMN_PLAYER_HEIGHT])
		);
		$player->setWeight(
			$this->buildWeight($record[PlayerInterface::COLUMN_PLAYER_WEIGHT])
		);
		$player->setCollege(static::toString($record[PlayerInterface::COLUMN_PLAYER_COLLEGE]));
		$player->setHighSchool(static::toString($record[PlayerInterface::COLUMN_PLAYER_HIGHSCHOOL]));

		$player->setGsisId(static::toString($record[PlayerInterface::COLUMN_PLAYER_GSIS_ID]));
		$player->setEspnId(static::toString($record[PlayerInterface::COLUMN_PLAYER_ESPN_ID]));
		$player->setSportradarId(static::toString($record[PlayerInterface::COLUMN_PLAYER_SPORTRADAR_ID]));
		$player->setYahooId(static::toString($record[PlayerInterface::COLUMN_PLAYER_YAHOO_ID]));
		$player->setRotowireId(static::toString($record[PlayerInterface::COLUMN_PLAYER_ROTOWIRE_ID]));

		$player->setHeadshotUrl(static::toString($record[PlayerInterface::COLUMN_PLAYER_HEADSHOT_URL]));

		return $player;
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
