Field mapping
=============

The following tables list the complete mapping of CSV columns to object attributes.

## Player

**CSV source**: [roster data](https://github.com/mrcaseb/nflfastR-roster/)

| class attribute | column        | comment        |
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
| lastUpdated     | -             | auto_generated |


### Height

**CSV source**: [roster data](https://github.com/mrcaseb/nflfastR-roster/)

**Class path**: Player.Height ([embedded](https://www.doctrine-project.org/projects/doctrine-orm/en/2.8/tutorials/embeddables.html))

| class attribute | column | comment                         |
|-----------------|--------|---------------------------------|
| feet            | height | Split from submitted value      |
| inches          | height | Split from submitted value      |
| cm              | height | Calculated from feet and inches |

### Weight

**CSV source**: [roster data](https://github.com/mrcaseb/nflfastR-roster/)

**Class path**: Player.Weight ([embedded](https://www.doctrine-project.org/projects/doctrine-orm/en/2.8/tutorials/embeddables.html))

| class attribute | column | comment                |
|-----------------|--------|------------------------|
| pounds          | weight |                        |
| kilograms       | weigth | Calculated from pounds |

## RosterAssignment

**CSV source**: [roster data](https://github.com/mrcaseb/nflfastR-roster/)

**Class path**: Player.RosterAssignment[]

| class attribute    | column               | comment                 |
|--------------------|----------------------|-------------------------|
| season             | season               |                         |
| position           | position             |                         |
| depthChartPosition | depth_chart_position |                         |
| jerseyNumber       | jersey_number        |                         |
| status             | status               | mapped to a limited set |
| lastUpdated        | -                    | auto_generated          |

### Status mapping

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

## Drive

## Game

## Play

## PlayerAssignment

## TeamAssignment

## ExpectedPoints

## WinProbability
