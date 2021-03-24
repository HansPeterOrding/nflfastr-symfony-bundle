<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Repository;

use Doctrine\Persistence\ManagerRegistry;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\GameInterface;

/**
 * @method findUniqueEntity(array $data): ?Game
 */
class GameRepository extends AbstractNflRepository implements NflRepositoryInterface
{
	const FIELD_GAME_ID = 'gameId';

	protected static array $uniqueEntityFields = [
		GameInterface::COLUMN_GAME_ID => self::FIELD_GAME_ID
	];

	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, Game::class);
	}
}
