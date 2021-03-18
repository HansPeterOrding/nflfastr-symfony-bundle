<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Repository;

use Doctrine\Persistence\ManagerRegistry;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Drive;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\DriveInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\PlayInterface;

class DriveRepository extends AbstractNflRepository implements NflRepositoryInterface
{
	const FIELD_GAME = 'game';
	const FIELD_NUMBER = 'number';

	protected static array $uniqueEntityFields = [
		PlayInterface::COLUMN_GAME_ID => self::FIELD_GAME,
		DriveInterface::COLUMN_DRIVE => self::FIELD_NUMBER
	];
	
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, Drive::class);
	}
	
	public function findUniqueEntity(array $data)
	{
		return $this->findOneBy([
			self::FIELD_GAME => $data[PlayInterface::COLUMN_GAME_ID],
			self::FIELD_NUMBER => $data[DriveInterface::COLUMN_DRIVE]
		]);
	}
}
