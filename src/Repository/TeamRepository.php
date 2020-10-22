<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Team;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\TeamInterface;

/**
 * @method findOneBy(array $criteria, array $orderBy = null): ?Team
 * @method findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null): Team[]
 * @method findAll(): Team[]
 * @method find($id, $lockMode = null, $lockVersion = null): Team[]
 */
class TeamRepository extends ServiceEntityRepository
{
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, Team::class);
	}

	public function persistTeam(Team $team, bool $flush = true): void
	{
		$this->getEntityManager()->persist($team);
		if ($flush) {
			$this->getEntityManager()->flush();
		}
	}

	public function deactivateAll()
	{
		$qb = $this->createQueryBuilder('t');

		$q = $qb->update(Team::class, 't')
			->set('t.status', ':status')
			->setParameter('status', TeamInterface::STATUS_INACTIVE)
			->getQuery();
		$q->execute();
	}

	public function findTeamByAbbreviation(string $abbreviation): ?Team
	{
		return $this->findOneBy(['abbreviation' => $abbreviation]);
	}
}
