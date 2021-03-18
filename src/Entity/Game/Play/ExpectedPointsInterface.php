<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play;

interface ExpectedPointsInterface
{
	const TEAM_TYPE_HOME = 'home';
	const TEAM_TYPE_AWAY = 'away';
	const TEAM_TYPE_POS = 'pos';

	const TYPE_COMP = 'comp';
	const TYPE_RAW = 'raw';
	const TYPE_RUSH = 'rush';
	const TYPE_PASS = 'pass';

	const AIR_OR_YAC_AIR = 'air';
	const AIR_OR_YAC_YAC = 'yac';
}
