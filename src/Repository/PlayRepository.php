<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Repository;

use Doctrine\Persistence\ManagerRegistry;
use HansPeterOrding\NflFastrSymfonyBundle\CsvConverter\AbstractCsvConverter;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\DriveInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\PlayInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\GameInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Team;

/**
 * @method findOneBy(array $criteria, array $orderBy = null): ?Team
 */
class PlayRepository extends AbstractNflRepository implements NflRepositoryInterface, PlayRepositoryInterface
{
	const FIELD_PLAY_ID = 'playId';
	const FIELD_GAME = 'game';
	const FIELD_DRIVE = 'drive';

	protected static array $uniqueEntityFields = [
		PlayInterface::COLUMN_PLAY_ID => self::FIELD_PLAY_ID,
		GameInterface::COLUMN_GAME_ID => self::FIELD_GAME,
		PlayInterface::COLUMN_DRIVE   => self::FIELD_DRIVE
	];

	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, Play::class);
	}

	/**
	 * @return Team|null
	 */
	public function findUniqueEntity(array $data)
	{
		return $this->findOneBy([
			self::FIELD_PLAY_ID => $data[PlayInterface::COLUMN_PLAY_ID],
			self::FIELD_GAME    => $data[PlayInterface::COLUMN_GAME_ID],
			self::FIELD_DRIVE   => $data[PlayInterface::COLUMN_DRIVE_ID]
		]);
	}

	public function playExists(array $data): bool
	{
		$qb = $this->createQueryBuilder('p');

		$qb->select('p.id')
			->join('p.game', 'g')
			->join('p.drive', 'd')
			->where(
				$qb->expr()->eq('g.gameId', ':gameId')
			)
			->andWhere(
				$qb->expr()->eq('p.playId', ':playId')
			)
			->andWhere(
				$qb->expr()->eq('d.number', ':number')
			)
			->setParameter('gameId', $data[GameInterface::COLUMN_GAME_ID])
			->setParameter('playId', $data[PlayInterface::COLUMN_PLAY_ID])
			->setParameter('number', AbstractCsvConverter::toInt($data[DriveInterface::COLUMN_DRIVE]));

		$play = $qb->getQuery()->getOneOrNullResult();
		if ($play) {
			return true;
		}

		return false;
	}
}
