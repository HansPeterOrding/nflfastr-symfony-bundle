<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Repository;

use Doctrine\Persistence\ManagerRegistry;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Player\RosterAssignment;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Player\RosterAssignmentInterface;

/**
 * @method findOneBy(array $criteria, array $orderBy = null): ?RosterAssignment
 * @method findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null): RosterAssignment[]
 * @method findAll(): RosterAssignment[]
 * @method find($id, $lockMode = null, $lockVersion = null): RosterAssignment[]
 */
class RosterAssignmentRepository extends AbstractNflRepository implements NflRepositoryInterface
{
	const FIELD_SEASON = 'season';
	const FIELD_PLAYER = 'player';

	protected static array $uniqueEntityFields = [
		RosterAssignmentInterface::COLUMN_ROSTERASSIGNMENT_SEASON => self::FIELD_SEASON,
		RosterAssignmentInterface::COLUMN_ROSTERASSIGNMENT_PLAYER => self::FIELD_PLAYER
	];

	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, RosterAssignment::class);
	}

	public function persistRosterAssignment(RosterAssignment $rosterAssignment, bool $flush = true): void
	{
		$this->getEntityManager()->persist($rosterAssignment);

		if ($flush) {
			$this->getEntityManager()->flush();
		}
	}

	/**
	 * @return RosterAssignment|null
	 */
	public function findUniqueEntity(array $data)
	{
		return $this->findOneBy([
			static::$uniqueEntityFields[RosterAssignmentInterface::COLUMN_ROSTERASSIGNMENT_SEASON] => $data[RosterAssignmentInterface::COLUMN_ROSTERASSIGNMENT_SEASON],
			static::$uniqueEntityFields[RosterAssignmentInterface::COLUMN_ROSTERASSIGNMENT_PLAYER] => $data[RosterAssignmentInterface::COLUMN_ROSTERASSIGNMENT_PLAYER]
		]);
	}
}
