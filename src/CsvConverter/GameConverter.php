<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\CsvConverter;

use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\GameInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Team;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\TeamInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Repository\GameRepository;

/**
 * @method getOrCreateEntity(array $data): Game
 */
class GameConverter extends AbstractCsvConverter implements GameConverterInterface
{
	public static array $seasonTypeMappings = [
		'REG'  => GameInterface::SEASON_TYPE_REGULAR,
		'POST' => GameInterface::SEASON_TYPE_POSTSEASON
	];

	private static array $gameDateSourceFormats = [
		'Y-m-d',
		'm/d/Y'
	];

	private static array $gameTimeSourceFormats = [
		'H:i',
		'H:i:s'
	];

	private TeamConverterInterface $teamConverter;

	public function __construct(
		GameRepository $repository,
		TeamConverterInterface $teamConverter
	) {
		$this->repository = $repository;
		$this->teamConverter = $teamConverter;
	}

	public function defineEntityClass()
	{
		$this->entityClass = Game::class;
	}

	public function toEntity(array $record): Game
	{
		/** @var Game $game */
		$game = $this->getOrCreateEntity($record);

		$game->setGameId(static::toString($record[GameInterface::COLUMN_GAME_ID]));
		$game->setOldGameId(static::toString($record[GameInterface::COLUMN_OLD_GAME_ID]));
		$game->setSeasonType(
			static::$seasonTypeMappings[$record[GameInterface::COLUMN_SEASON_TYPE]]
		);
		$game->setWeek(static::toInt($record[GameInterface::COLUMN_WEEK]));
		$game->setDateTime(
			static::combineDateAndTime(
				$record[GameInterface::COLUMN_GAME_DATE],
				$record[GameInterface::COLUMN_START_TIME]
			)
		);
		$game->setTotalScoreHomeTeam(static::toInt($record[GameInterface::COLUMN_TOTAL_HOME_SCORE]));
		$game->setTotalScoreAwayTeam(static::toInt($record[GameInterface::COLUMN_TOTAL_AWAY_SCORE]));

		$teamHome = $this->getOrCreateTeam($record, GameInterface::COLUMN_HOME_TEAM);
		$game->setTeamHome($teamHome);

		$teamAway = $this->getOrCreateTeam($record, GameInterface::COLUMN_AWAY_TEAM);
		$game->setTeamAway($teamAway);

		return $game;
	}

	private function getOrCreateTeam(array $record, $teamAbbreviationColumn): Team
	{
		$teamRecord = [
			TeamInterface::COLUMN_SEASON            => $record[Game\PlayInterface::COLUMN_SEASON],
			TeamInterface::COLUMN_TEAM_ABBREVIATION => $record[$teamAbbreviationColumn]
		];

		return $this->teamConverter->toEntity($teamRecord);
	}
}
