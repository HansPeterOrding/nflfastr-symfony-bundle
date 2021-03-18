<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play;

interface TeamAssignmentInterface
{
	const TEAM_ASSIGNMENT_TYPE_POSESSION = 'posesion';
	const TEAM_ASSIGNMENT_TYPE_DEFENSE = 'defense';
	const TEAM_ASSIGNMENT_TYPE_TIMEOUT = 'timeout';
	const TEAM_ASSIGNMENT_TYPE_TOUCHDOWN = 'touchdown';
	const TEAM_ASSIGNMENT_TYPE_FORCED_FUMBLE = 'forcedFumble';
	const TEAM_ASSIGNMENT_TYPE_SOLO_TACKLE = 'soloTackle';
	const TEAM_ASSIGNMENT_TYPE_ASSIST_TACKLE = 'assistTackle';
	const TEAM_ASSIGNMENT_TYPE_TACKLE_WITH_ASSIST = 'tackleWithAssist';
	const TEAM_ASSIGNMENT_TYPE_FUMBLED = 'fumbled';
	const TEAM_ASSIGNMENT_TYPE_FUMBLE_RECOVERY = 'fumbleRecovery';
	const TEAM_ASSIGNMENT_TYPE_RETURN = 'return';
	const TEAM_ASSIGNMENT_TYPE_PENALTY = 'penalty';
}
