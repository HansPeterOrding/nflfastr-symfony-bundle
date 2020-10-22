<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Entity;

interface PlayerInterface
{
	public const COLUMN_PLAYER_FIRSTNAME = 'first_name';
	public const COLUMN_PLAYER_LASTNAME = 'last_name';
	public const COLUMN_PLAYER_FULLNAME = 'full_name';
	public const COLUMN_PLAYER_BIRTHDATE = 'birth_date';
	public const COLUMN_PLAYER_HEIGHT = 'height';
	public const COLUMN_PLAYER_WEIGHT = 'weight';
	public const COLUMN_PLAYER_COLLEGE = 'college';
	public const COLUMN_PLAYER_HIGHSCHOOL = 'high_school';
	public const COLUMN_PLAYER_GSIS_ID = 'gsis_id';
	public const COLUMN_PLAYER_ESPN_ID = 'espn_id';
	public const COLUMN_PLAYER_SPORTRADAR_ID = 'sportradar_id';
	public const COLUMN_PLAYER_YAHOO_ID = 'yahoo_id';
	public const COLUMN_PLAYER_ROTOWIRE_ID = 'rotowire_id';
	public const COLUMN_PLAYER_HEADSHOT_URL = 'headshot_url';
}
