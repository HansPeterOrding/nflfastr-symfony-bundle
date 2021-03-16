<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Repository;

use Doctrine\Persistence\ManagerRegistry;
use HansPeterOrding\NflFastrSymfonyBundle\CsvConverter\PlayerConverter;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Player;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\PlayerInterface;

/**
 * @method findOneBy(array $criteria, array $orderBy = null): ?Player
 * @method findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null): Player[]
 * @method findAll(): Player[]
 * @method find($id, $lockMode = null, $lockVersion = null): Player[]
 */
class PlayerRepository extends AbstractNflRepository implements NflRepositoryInterface
{
	const FIELD_GSIS_ID = 'gsisId';
	const FIELD_ESPN_ID = 'espnId';
	const FIELD_SPORTRADAR_ID = 'sportradarId';
	const FIELD_YAHOO_ID = 'yahooId';
	const FIELD_ROTOWIRE_ID = 'rotowireId';
	const FIELD_FIRSTNAME = 'firstName';
	const FIELD_LASTNAME = 'lastName';
	const FIELD_BIRTHDATE = 'birthDate';

	protected static array $uniqueEntityFields = [
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

	/**
	 * @param array $data
	 * @return Player|null
	 */
	public function findUniqueEntity(array $data)
	{
		/** @var Player|null $player */
		$player = parent::findUniqueEntity($data);

		if (!$player) {
			$birthdate = PlayerConverter::buildBirthDate($data[PlayerInterface::COLUMN_PLAYER_BIRTHDATE]);
			$player = $this->findOneBy([
				self::FIELD_FIRSTNAME => $data[PlayerInterface::COLUMN_PLAYER_FIRSTNAME],
				self::FIELD_LASTNAME  => $data[PlayerInterface::COLUMN_PLAYER_LASTNAME],
				self::FIELD_BIRTHDATE => $birthdate
			]);
		}

		return $player;
	}
}
