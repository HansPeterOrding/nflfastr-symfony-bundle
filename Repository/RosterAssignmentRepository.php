<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Player;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\RosterAssignment;

/**
 * @method findOneBy(array $criteria, array $orderBy = null): ?RosterAssignment
 * @method findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null): RosterAssignment[]
 * @method findAll(): RosterAssignment[]
 * @method find($id, $lockMode = null, $lockVersion = null): RosterAssignment[]
 */
class RosterAssignmentRepository extends ServiceEntityRepository
{
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

	public function findCurrentRosterAssignment(int $season, Player $player): ?RosterAssignment
	{
		return $this->findOneBy([
			'season' => $season,
			'player' => $player->getId()
		]);
	}
}
