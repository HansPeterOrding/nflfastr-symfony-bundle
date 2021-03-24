Field mapping
=============

The following tables list the complete mapping of CSV columns to object attributes.

## Player

**CSV source**: [roster data](https://github.com/mrcaseb/nflfastR-roster/)

**Class paths**:

* `{RosterAssignment.Player}` 
* `{PlayerAssignment.Player}`

| class attribute | columns       | comment        |
|-----------------|---------------|----------------|
| id              | -             | auto generated |
| firstName       | first_name    |                |
| lastName        | last_name     |                |
| birthDate       | birth_date    |                |
| college         | college       |                |
| highSchool      | high_school   |                |
| gsisId          | gsis_id       |                |
| espnId          | espn_id       |                |
| sportradarId    | sportradar_id |                |
| yahooId         | yahoo_id      |                |
| rotowireId      | rotowire_id   |                |
| headshotUrl     | headshot_url  |                |
| lastUpdated     | -             | auto generated |

### Height

**CSV source**: [roster data](https://github.com/mrcaseb/nflfastR-roster/)

**Class paths**:

* `{Player.Height}` ([embedded](https://www.doctrine-project.org/projects/doctrine-orm/en/2.8/tutorials/embeddables.html))

| class attribute | columns | comment                         |
|-----------------|---------|---------------------------------|
| feet            | height  | Split from submitted value      |
| inches          | height  | Split from submitted value      |
| cm              | height  | Calculated from feet and inches |

### Weight

**CSV source**: [roster data](https://github.com/mrcaseb/nflfastR-roster/)

**Class paths**:

* `{Player.Weight}` ([embedded](https://www.doctrine-project.org/projects/doctrine-orm/en/2.8/tutorials/embeddables.html))

| class attribute | columns | comment                |
|-----------------|---------|------------------------|
| pounds          | weight  |                        |
| kilograms       | weigth  | Calculated from pounds |

## RosterAssignment

**CSV source**: [roster data](https://github.com/mrcaseb/nflfastR-roster/)

**Class paths**:

* `{Team.RosterAssignment[]}`
* `{Player.RosterAssignment[]}`

| class attribute    | columns              | comment                 |
|--------------------|----------------------|-------------------------|
| id                 | -                    | auto generated          |
| season             | season               |                         |
| position           | position             |                         |
| depthChartPosition | depth_chart_position |                         |
| jerseyNumber       | jersey_number        |                         |
| status             | status               | mapped to a limited set |
| lastUpdated        | -                    | auto generated          |

### Mappings

#### Status mapping

| CSV value                    | class value                  |
|------------------------------|------------------------------|
| ACT                          | Active                       |
| Active                       | Active                       |
| CUT                          | Inactive                     |
| DEV                          | Practice Squad               |
| EXE                          | Inactive                     |
| Inactive                     | Inactive                     |
| Injured Reserve              | Injured Reserve              |
| NA                           | Inactive                     |
| NON                          | Inactive                     |
| NWT                          | Inactive                     |
| Physically Unable to Perform | Physically Unable to Perform |
| Practice Squad               | Practice Squad               |
| PUP                          | Physically Unable to Perform |
| RES                          | Injured Reserve              |
| Reserve/COVID-19             | Reserve/COVID-19             |
| RET                          | Inactive                     |
| RFA                          | Inactive                     |
| RSN                          | Inactive                     |
| SUS                          | Inactive                     |
| TRC                          | Inactive                     |
| TRD                          | Inactive                     |
| TRT                          | Inactive                     |
| UDF                          | Inactive                     |
| UFA                          | Inactive                     |
| Voluntary Opt Out            | Voluntary Opt Out            |

## Team

**CSV source**: [roster data](https://github.com/mrcaseb/nflfastR-roster/)

**Class paths**:

* `{RosterAssignment.Team}`
* `{Game.teamHome}`
* `{Game.teamAway}`
* `{TeamAssignment.Team}`

| class attribute | columns | comment                                    |
|-----------------|---------|--------------------------------------------|
| id              | -       |                                            |
| abbreviation    | team    | Calculated from pounds                     |
| name            | team    | mapped to a predefined set                 | 
| status          | season  | mapped to active if season is current year |

### Mappings

#### Name mapping

| CSV value | class value              |
|-----------|--------------------------|
| ARI       | Arizona Cardinals        |
| ATL       | Atlanta Falcons          |
| BAL       | Baltimore Ravens         |
| BUF       | Buffalo Bills            |
| CAR       | Carolina Panthers        |
| CHI       | Chigaco Bears            |
| CIN       | Cincinnati Bengals       |
| CLE       | Cleveland Browns         |
| DAL       | Dallas Cowboys           |
| DEN       | Denver Broncos           |
| DET       | Detroit Lions            |
| GB        | Green Bay Packers        |
| OU        | Houston Texans           |
| IND       | Indianapolis Colts       |
| JAX       | Jacksonville Jaguars     |
| KC        | Kansas City Chiefs       |
| LA        | Los Angeles Rams         |
| LAC       | Los Angeles Chargers     |
| LAR       | Los Angeles Rams         |
| LV        | Las Vegas Raiders        |
| MIA       | Miami Dolphins           |
| MIN       | Minnesota Vikings        |
| NE        | New England Patriots     |
| NO        | New Orleans Saints       |
| NYG       | New York Giants          |
| NYJ       | New York Jets            |
| OAK       | Oakland Raiders          |
| PHI       | Philadelphia Eagles      |
| PIT       | Pittsburgh Steelers      |
| SEA       | Seattle Seahawks         |
| STL       | St. Louis Rams           |
| SF        | San Francisco 49ers      |
| SD        | San Diego Chargers       |
| TB        | Tampa Bay Buccaneers     |
| TEN       | Tennessee Titans         |
| WAS       | Washington Football Team |
| NA        | None                     |

## Drive

**CSV source**: [play by play data](https://github.com/guga31bb/nflfastR-data/)

**Class paths**:

* `{Game.Drive[]}`
* `{Play.Drive}`

| class attribute | columns                  | comment        |
|-----------------|--------------------------|----------------|
| id              | -                        | auto generated |
| number          | drive                    |                |
| realStartTime   | drive_real_start_time    |                |
| playCount       | drive_play_count         |                |
| timeOfPosession | drive_time_of_possession |                |
| firstDowns      | drive_first_downs        |                |
| insideTwenty    | drive_inside20           |                |
| endedWithScore  | drive_ended_with_score   |                |
| quarterStart    | drive_quarter_start      |                |
| quarterEnd      | drive_quarter_end        |                |
| yardsPenalized  | drive_yards_penalized    |                |
| startTransition | drive_start_transition   |                |
| endTransition   | drive_end_transition     |                |
| gameClockStart  | drive_game_clock_start   |                |
| gameClockEnd    | drive_game_clock_end     |                |
| startYardLine   | drive_start_yard_line    |                |
| endYardLine     | drive_end_yard_line      |                |

## Game

**CSV source**: [play by play data](https://github.com/guga31bb/nflfastR-data/)

**Class paths**:

* `{Team.Game[]}` as homeGames
* `{Team.Game[]}` as awayGames
* `{Play.Game}`
* `{Drive.Game}`

| class attribute    | columns               | comment                    |
|--------------------|-----------------------|----------------------------|
| id                 | -                     |                            |
| gameId             | game_id               |                            |
| oldGameId          | old_game_id           |                            |
| seasonType         | season_type           | mapped to a predefined set |
| week               | week                  |                            |
| datetime           | game_date, start_time |                            |
| totalScoreHomeTeam | home_score            |                            |
| totalScoreAwayTeam | away_score            |                            |

### Mappings

#### SeasonType mapping

| CSV value | class value |
|-----------|-------------|
| REG       | reg         |
| POST      | post        |

## Play

**CSV source**: [play by play data](https://github.com/guga31bb/nflfastR-data/)

**Class paths**:

* `{Game.Play[]}`
* `{Drive.Play[]}`
* `{ExpectedPoints.Play}`
* `{WinProbability.Play}`
* `{PlayerAssignmetns.Play}`
* `{TeamAssignments.Play}`

| class attribute           | columns                   | comment                            |
|---------------------------|---------------------------|------------------------------------|
| id                        | -                         | auto generated                     |
| playId                    | play_id                   |                                    |
| possessionTeamSideOfField | side_of_field             |                                    |
| yardLine100               | yardline_100              |                                    |
| secondsRemainingQuarter   | quarter_seconds_remaining |                                    |
| secondsRemainingHalf      | half_seconds_remaining    |                                    |
| secondsRemainingGame      | game_seconds_remaining    |                                    |
| gameHalf                  | game_half                 | mapped to a predefined set         |
| quarterEnd                | quarter_end               |                                    |
| scorePlay                 | sp                        |                                    |
| quarter                   | qtr                       |                                    |
| down                      | down                      |                                    |
| goalToGo                  | goal_to_go                |                                    |
| time                      | time                      |                                    |
| yardsToGo                 | ydstogo                   |                                    |
| yardsNet                  | ydsnet                    |                                    |
| description               | desc                      |                                    |
| type                      | play_type                 | mapped to a predefined set         |
| yardsGained               | yards_gained              |                                    |
| originalPlayData          | -                         | complete array of original csv row | 

### Flags

**CSV source**: [play by play data](https://github.com/guga31bb/nflfastR-data/)

**Class paths**:

* `{Play.Flags}` ([embedded](https://www.doctrine-project.org/projects/doctrine-orm/en/2.8/tutorials/embeddables.html))

| class attribute      | columns                 | comment |
|----------------------|-------------------------|---------|
| shotgun              | shotgun                 |         |
| noHuddle             | no_huddle               |         |
| qbDropback           | qb_dropback             |         |
| qbKneel              | qb_kneel                |         |
| qbSpike              | qb_spike                |         |
| qbScramble           | qb_scramble             |         |
| puntBlocked          | punt_blocked            |         |
| firstDownRush        | first_down_rush         |         |
| firstDownPass        | first_down_pass         |         |
| firstDownPenalty     | first_down_penalty      |         |
| thirdDownConverted   | third_down_converted    |         |
| thirdDownFailed      | third_down_failed       |         |
| fourthDownConverted  | fourth_down_converted   |         |
| fourthDownFailed     | fourth_down_failed      |         |
| incompletePass       | incomplete_pass         |         |
| touchback            | touchback               |         |
| interception         | interception            |         |
| puntInsideTwenty     | punt_inside_twenty      |         |
| puntInEndzone        | punt_in_endzone         |         |
| puntOutOfBounds      | punt_out_of_bounds      |         |
| puntDowned           | punt_downed             |         |
| puntFairCatch        | punt_fair_catch         |         |
| kickoffInsideTwenty  | kickoff_inside_twenty   |         |
| kickoffInEndzone     | kickoff_in_endzone      |         |
| kickoffOutOfBounds   | kickoff_out_of_bounds   |         |
| kickoffDowned        | kickoff_downed          |         |
| kickoffFairCatch     | kickoff_fair_catch      |         |
| fumbleForced         | fumble_forced           |         |
| fumbleNotForced      | fumble_not_forced       |         |
| fumbleOutOfBounds    | fumble_out_of_bounds    |         |
| soloTackle           | solo_tackle             |         |
| safety               | safety                  |         |
| penalty              | penalty                 |         |
| tackledForLoss       | tackled_for_loss        |         |
| fumbleLost           | fumble_lost             |         |
| ownKickoffRecovery   | own_kickoff_recovery    |         |
| ownKickoffRecoveryTd | own_kickoff_recovery_td |         |
| qbHit                | qb_hit                  |         |
| rushAttempt          | rush_attempt            |         |
| passAttempt          | pass_attempt            |         |
| sack                 | sack                    |         |
| touchdown            | touchdown               |         |
| passTouchdown        | pass_touchdown          |         |
| rushTouchdown        | rush_touchdown          |         |
| returnTouchdown      | return_touchdown        |         |
| extraPointAttempt    | extra_point_attempt     |         |
| twoPointAttempt      | two_point_attempt       |         |
| fieldGoalAttempt     | field_goal_attempt      |         |
| kickoffAttempt       | kickoff_attempt         |         |
| puntAttempt          | punt_attempt            |         |
| fumble               | fumble                  |         |
| completePass         | complete_pass           |         |
| assistTackle         | assist_tackle           |         |
| lateralReception     | lateral_reception       |         |
| lateralRush          | lateral_rush            |         |
| lateralReturn        | lateral_return          |         |
| lateralRecovery      | lateral_recovery        |         |

### Mappings

#### GameHalf mappings

| CSV value | class value |
|-----------|-------------|
| Half1     | first       |
| Half2     | second      |
| Overtime  | overtime    |

#### PlayType mappings

| CSV value   | class value |
|-------------|-------------|
| pass        | pass        |
| run         | run         |
| punt        | punt        |
| field_goal  | field_goal  |
| kickoff     | kickoff     |
| extra_point | extra_point |
| qb_kneel    | qb_kneel    |
| qb_spike    | qb_spike    |
| no_play     | no_play     |
| missing     | end_of_play |
| NA          | null        |

## PlayerAssignment

**CSV source**: [play by play data](https://github.com/guga31bb/nflfastR-data/)

**Class paths**:

* `{Player.PlayerAssignment[]}`
* `{Play.PlayerAssignment[]}`

| class attribute | columns  | comment                                            |
|-----------------|----------|----------------------------------------------------|
| id              | -        | auto generated                                     |
| type            | multiple | mapped to a predefined set depending on csv column |
| yards           | multiple | mapped to a predefined set depending on csv column |
| orderNumber     | multiple | mapped to a predefined set depending on csv column |

### Mappings

#### Column to attribute mappings

| CSV Column                         | type value             | yards column            | order number |
|------------------------------------|------------------------|-------------------------|--------------|
| td_player_id                       | td                     | -                       | 1            |
| passer_player_id                   | passer                 | passing_yards           | 1            |
| receiver_player_id                 | receiver               | receiving_yards         | 1            |
| rusher_player_id                   | rusher                 | rushing_yards           | 1            |
| lateral_receiver_player_id         | lateralReceiver        | lateral_receiving_yards | 1            |
| lateral_rusher_player_id           | lateralRusher          | lateral_rushing_yards   | 1            |
| lateral_sack_player_id             | lateralSack            | -                       | 1            |
| interception_player_id             | interception           | -                       | 1            |
| lateral_interception_player_id     | lateralInterception    | -                       | 1            |
| punt_returner_player_id            | puntReturner           | return_yards            | 1            |
| lateral_punt_returner_player_id    | lateralPuntReturner    | return_yards            | 1            |
| kickoff_returner_player_id         | kickoffReturner        | return_yards            | 1            |
| lateral_kickoff_returner_player_id | lateralKickoffReturner | return_yards            | 1            |
| punter_player_id                   | punter                 | -                       | 1            |
| kicker_player_id                   | kicker                 | -                       | 1            |
| own_kickoff_recovery_player_id     | ownKickoffRecovery     | -                       | 1            |
| blocked_player_id                  | blocked                | -                       | 1            |
| tackle_for_loss_1_player_id        | tackleForLoss          | -                       | 1            |
| tackle_for_loss_2_player_id        | tackleForLoss          | -                       | 2            |
| qb_hit_1_player_id                 | qbHit                  | -                       | 1            |
| qb_hit_2_player_id                 | qbHit                  | -                       | 2            |
| forced_fumble_player_1_player_id   | forcedFumble           | -                       | 1            |
| forced_fumble_player_2_player_id   | forcedFumble           | -                       | 2            |
| solo_tackle_1_player_id            | soloTackle             | -                       | 1            |
| solo_tackle_2_player_id            | soloTackle             | -                       | 2            |
| assist_tackle_1_player_id          | assistTackle           | -                       | 1            |
| assist_tackle_2_player_id          | assistTackle           | -                       | 2            |
| assist_tackle_3_player_id          | assistTackle           | -                       | 3            |
| assist_tackle_4_player_id          | assistTackle           | -                       | 4            |
| tackle_with_assist_1_player_id     | tackleWithAssist       | -                       | 1            |
| tackle_with_assist_2_player_id     | tackleWithAssist       | -                       | 2            |
| pass_defense_1_player_id           | passDefense            | -                       | 1            |
| pass_defense_2_player_id           | passDefense            | -                       | 2            |
| fumbled_1_player_id                | fumbled                | -                       | 1            |
| fumbled_2_player_id                | fumbled                | -                       | 2            |
| fumble_recovery_1_player_id        | fumbleRecovery         | fumble_recovery_1_yards | 1            |
| fumble_recovery_2_player_id        | fumbleRecovery         | fumble_recovery_2_yards | 2            |
| penalty_player_id                  | penalty                | penalty_yards           | 1            |
| fantasy_player_id                  | fantasy                | -                       | 1            |

## TeamAssignment

**CSV source**: [play by play data](https://github.com/guga31bb/nflfastR-data/)

**Class paths**:

* `{Team.TeamAssignment[]}`
* `{Play.TeamAssignment[]}`

| class attribute | columns  | comment                                            |
|-----------------|----------|----------------------------------------------------|
| id              | -        | auto generated                                     |
| type            | multiple | mapped to a predefined set depending on csv column |
| yards           | multiple | mapped to a predefined set depending on csv column |
| orderNumber     | multiple | mapped to a predefined set depending on csv column |

### Mappings

#### Column to attribute mappings

| CSV Column                  | type value       | yards column            | order number |
|-----------------------------|------------------|-------------------------|--------------|
| posteam                     | posesion         | -                       | 1            |
| defteam                     | defense          | -                       | 1            |
| timeout_team                | timeout          | -                       | 1            |
| td_team                     | touchdown        | -                       | 1            |
| forced_fumble_player_1_team | forcedFumble     | -                       | 1            |
| forced_fumble_player_2_team | forcedFumble     | -                       | 2            |
| solo_tackle_1_team          | soloTackle       | -                       | 1            |
| solo_tackle_2_team          | soloTackle       | -                       | 2            |
| assist_tackle_1_team        | assistTackle     | -                       | 1            |
| assist_tackle_2_team        | assistTackle     | -                       | 2            |
| assist_tackle_3_team        | assistTackle     | -                       | 3            |
| assist_tackle_4_team        | assistTackle     | -                       | 4            |
| tackle_with_assist_1_team   | tackleWithAssist | -                       | 1            |
| tackle_with_assist_2_team   | tackleWithAssist | -                       | 2            |
| fumbled_1_team              | fumbled          | -                       | 1            |
| fumbled_2_team              | fumbled          | -                       | 2            |
| fumble_recovery_1_team      | fumbleRecovery   | fumble_recovery_1_yards | 1            |
| fumble_recovery_2_team      | fumbleRecovery   | fumble_recovery_2_yards | 2            |
| return_team                 | return           | return_yards            | 1            |
| penalty_team                | penalty          | penalty_yards           | 1            |

## ExpectedPoints

**CSV source**: [play by play data](https://github.com/guga31bb/nflfastR-data/)

**Class paths**:

* `{Play.ExpectedPoints[]}`

| class attribute | columns  | comment                                            |
|-----------------|----------|----------------------------------------------------|
| id              | -        | auto generated                                     |
| points          | multiple | mapped to a predefined set depending on csv column |
| teamType        | multiple | mapped to a predefined set depending on csv column |
| added           | multiple | mapped to a predefined set depending on csv column |
| type            | multiple | mapped to a predefined set depending on csv column |
| airOrYac        | multiple | mapped to a predefined set depending on csv column |

### Mapping

#### Column to attribute mappings

| CSV Column (points)     | teamType value  | added value | type value | airOrYac value |
|-------------------------|-----------------|-------------|------------|----------------|
| ep                      | pos             | false       | -          | -              |
| epa                     | pos             | true        | -          | -              |
| total_home_epa          | home            | true        | -          | -              |
| total_away_epa          | away            | true        | -          | -              |
| total_home_rush_epa     | home            | true        | rush       | -              |
| total_away_rush_epa     | away            | true        | rush       | -              |
| total_home_pass_epa     | home            | true        | pass       | -              |
| total_away_pass_epa     | away            | true        | pass       | -              |
| air_epa                 | -               | true        | -          | air            |
| yac_epa                 | pos             | true        | -          | yac            |
| comp_air_epa            | -               | true        | comp       | air            |
| comp_yac_epa            | -               | true        | comp       | yac            |
| total_home_comp_air_epa | home            | true        | comp       | air            |
| total_away_comp_air_epa | away            | true        | comp       | air            |
| total_home_comp_yac_epa | home            | true        | comp       | yac            |
| total_away_comp_yac_epa | away            | true        | comp       | yac            |
| total_home_raw_air_epa  | home            | true        | raw        | air            |
| total_away_raw_air_epa  | away            | true        | raw        | air            |
| total_home_raw_yac_epa  | home            | true        | raw        | yac            |
| total_away_raw_yac_epa  | away            | true        | raw        | yac            |

## WinProbability

**CSV source**: [play by play data](https://github.com/guga31bb/nflfastR-data/)

**Class paths**:

* `{Play.WinProbability[]}`

| class attribute | columns  | comment                                            |
|-----------------|----------|----------------------------------------------------|
| id              | -        | auto generated                                     |
| points          | multiple | mapped to a predefined set depending on csv column |
| teamType        | multiple | mapped to a predefined set depending on csv column |
| added           | multiple | mapped to a predefined set depending on csv column |
| vegas           | multiple | mapped to a predefined set depending on csv column |
| type            | multiple | mapped to a predefined set depending on csv column |
| airOrYac        | multiple | mapped to a predefined set depending on csv column |

### Mapping

#### Column to attribute mappings

| CSV Column (points)     | teamType value | added value | vegas value | type value | airOrYac value |
|-------------------------|----------------|-------------|-------------|------------|----------------|
| wp                      | pos            | false       | false       | -          | -              |
| def_wp                  | def            | false       | false       | -          | -              |
| home_wp                 | home           | false       | false       | -          | -              |
| away_wp                 | away           | false       | false       | -          | -              |
| wpa                     | pos            | true        | false       | -          | -              |
| vegas_wpa               | pos            | true        | true        | -          | -              |
| vegas_home_wpa          | home           | true        | true        | -          | -              |
| home_wp_post            | home           | false       | false       | post       | -              |
| away_wp_post            | away           | false       | false       | post       | -              |
| vegas_wp                | pos            | false       | true        | -          | -              |
| vegas_home_wp           | home           | false       | true        | -          | -              |
| total_home_rush_wpa     | home           | true        | false       | rush       | -              |
| total_away_rush_wpa     | away           | true        | false       | rush       | -              |
| total_home_pass_wpa     | home           | true        | false       | pass       | -              |
| total_away_pass_wpa     | away           | true        | false       | pass       | -              |
| yac_wpa                 | -              | true        | false       | -          | yac            |
| comp_air_wpa            | -              | true        | false       | comp       | air            |
| comp_yac_wpa            | -              | true        | false       | comp       | yac            |
| total_home_comp_air_wpa | home           | true        | false       | comp       | air            |
| total_away_comp_air_wpa | away           | true        | false       | comp       | air            |
| total_home_comp_yac_wpa | home           | true        | false       | comp       | yac            |
| total_away_comp_yac_wpa | away           | true        | false       | comp       | yac            |
| total_home_raw_air_wpa  | home           | true        | false       | raw        | air            |
| total_away_raw_air_wpa  | away           | true        | false       | raw        | air            |
| total_home_raw_yac_wpa  | home           | true        | false       | raw        | yac            |
| total_away_raw_yac_wpa  | away           | true        | false       | raw        | yac            |
