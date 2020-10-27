<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Entity;

interface TeamInterface
{
	public const STATUS_ACTIVE = 'active';
	public const STATUS_INACTIVE = 'inactive';

	public const COLUMN_TEAM_ABBREVIATION = 'team';
	public const COLUMN_SEASON = 'season';

	public const TEAM_TITLE_ARI = 'Arizona Cardinals';
	public const TEAM_TITLE_ATL = 'Atlanta Falcons';
	public const TEAM_TITLE_BAL = 'Baltimore Ravens';
	public const TEAM_TITLE_BUF = 'Buffalo Bills';
	public const TEAM_TITLE_CAR = 'Carolina Panthers';
	public const TEAM_TITLE_CHI = 'Chigaco Bears';
	public const TEAM_TITLE_CIN = 'Cincinnati Bengals';
	public const TEAM_TITLE_CLE = 'Cleveland Browns';
	public const TEAM_TITLE_DAL = 'Dallas Cowboys';
	public const TEAM_TITLE_DEN = 'Denver Broncos';
	public const TEAM_TITLE_DET = 'Detroit Lions';
	public const TEAM_TITLE_GB = 'Green Bay Packers';
	public const TEAM_TITLE_HOU = 'Houston Texans';
	public const TEAM_TITLE_IND = 'Indianapolis Colts';
	public const TEAM_TITLE_JAX = 'Jacksonville Jaguars';
	public const TEAM_TITLE_KC = 'Kansas City Chiefs';
	public const TEAM_TITLE_LA = 'Los Angeles Rams';
	public const TEAM_TITLE_LAC = 'Los Angeles Chargers';
	public const TEAM_TITLE_LAR = 'Los Angeles Rams';
	public const TEAM_TITLE_LV = 'Las Vegas Raiders';
	public const TEAM_TITLE_MIA = 'Miami Dolphins';
	public const TEAM_TITLE_MIN = 'Minnesota Vikings';
	public const TEAM_TITLE_NE = 'New England Patriots';
	public const TEAM_TITLE_NO = 'New Orleans Saints';
	public const TEAM_TITLE_NYG = 'New York Giants';
	public const TEAM_TITLE_NYJ = 'New York Jets';
	public const TEAM_TITLE_OAK = 'Oakland Raiders';
	public const TEAM_TITLE_PHI = 'Philadelphia Eagles';
	public const TEAM_TITLE_PIT = 'Pittsburgh Steelers';
	public const TEAM_TITLE_SEA = 'Seattle Seahawks';
	public const TEAM_TITLE_STL = 'St. Louis Rams';
	public const TEAM_TITLE_SF = 'San Francisco 49ers';
	public const TEAM_TITLE_SD = 'San Diego Chargers';
	public const TEAM_TITLE_TB = 'Tampa Bay Buccaneers';
	public const TEAM_TITLE_TEN = 'Tennessee Titans';
	public const TEAM_TITLE_WAS = 'Washington Football Team';
	public const TEAM_TITLE_NA = 'None';
}
