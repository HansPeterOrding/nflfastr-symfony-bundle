<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Repository;

use App\Repository\AbstractNflRepository;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\Persistence\ManagerRegistry;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Player;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\PlayerInterface;

/**
 * @method findOneBy(array $criteria, array $orderBy = null): ?Player
 * @method findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null): Player[]
 * @method findAll(): Player[]
 * @method find($id, $lockMode = null, $lockVersion = null): Player[]
 * @method findUniqueEntity(array $data) : ?Player
 */
class PlayerRepository extends AbstractNflRepository implements NflRepositoryInterface
{
	const FIELD_GSIS_ID = 'gsisId';
	const FIELD_ESPN_ID = 'espnId';
	const FIELD_SPORTRADAR_ID = 'sportradarId';
	const FIELD_YAHOO_ID = 'yahooId';
	const FIELD_ROTOWIRE_ID = 'rotowireId';

	private static array $uniqueEntityFields = [
		PlayerInterface::COLUMN_PLAYER_GSIS_ID       => self::FIELD_GSIS_ID,
		PlayerInterface::COLUMN_PLAYER_ESPN_ID       => self::FIELD_ESPN_ID,
		PlayerInterface::COLUMN_PLAYER_SPORTRADAR_ID => self::FIELD_SPORTRADAR_ID,
		PlayerInterface::COLUMN_PLAYER_YAHOO_ID      => self::FIELD_YAHOO_ID,
		PlayerInterface::COLUMN_PLAYER_ROTOWIRE_ID   => self::FIELD_ROTOWIRE_ID
	];

	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, Player::class);
	}

	public function persistPlayer(Player $player, bool $flush = true): void
	{
		$this->getEntityManager()->persist($player);

		if ($flush) {
			$this->getEntityManager()->flush();
		}
	}

	public function findPlayerBySportradarId(string $sportradarId): ?Player
	{
		return $this->findOneBy(['sportradarId' => $sportradarId]);
	}

	public function findPlayerByGsisId(string $gsisId): ?Player
	{
		return $this->findOneBy(['gsisId' => $gsisId]);
	}
}
