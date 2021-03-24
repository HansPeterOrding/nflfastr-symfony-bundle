Import strategies
=================

Importing flat CSV data to multi dimendional entities required some aggregation. Starting with lines in the CSV files, the bundle creates two "main" entities that match exactly one line of the underlying CSV file:

* `{RosterAssignment}` for nflfastR-roster CSVs
* `{Play}` for nflfastR-data play by play data

Based on the [entity structure](entities.md) the aggregations where logically derived and followed some basic rules:

* Entities are always identified by a set of defining columns.
> Example: Plays are defined by columns `play_id`, `game_id` and `drive`. If these columns have the same value combination, it is the same game.
* Entities present in more than one line (e.g. Teams) are always updated if the defining columns match. In result, the entities contain the newest set of not defining properties.
> Example: `{Game}` is defined by column `gameId`. All other fields of a `{Game}` entity are set to the last imported column values.
* All properties are stored in an appropriate format. This applies to PHP objects and database entities.
> Example: The `{Game}`'s start_time is converted to a `{DateTime}` object in PHP. It is stored in a time column in the database.
* Belonging columns are joined to one attribute if this makes the handling easier.
> Example: Columns `game_date` and `start_time` are joined to one `{DateTime}` object resp. one datetime column in the database (`{Game.datetime}`).
* Columns that contain combined data are split into multiple attributes if this makes the handling easier or gives more flexibility.
> Example: Column `height` is split into `feet` and `inches` to allow versatile displaying.
* Columns that are regional are converted implicitly in necessary attributes
> Example: `{Height}` and `{Weight}` contain metric units and imperial units (i.e. kilograms and pounds resp. centimeters and feet/inches)

## Different approaches

To allow the import for as many consumers (i.e. user of this bundle) as possible, the bundle implements multiple approaches for the import process itself.
Each approach comes with up- and downsides and matches different archtictural environments. As this can be a very individual decision, you can decide on your own, which approach to use.

### Symfony Messenger approach

This approach makes use of the symfony messenger components and requires two steps for each import:

1. Create a message for each column of a processed CSV file
2. Start a worker to actually import the data message wise

#### Up- and downsides

Upsides:
* No need to take care of memory usage
* Runs in background
* Can be automated easily
* Faster

Downsides:
* Asynchronous
* Needs more setup effort

#### Instructions to import

To use the symfony messenger approach, you have to require the messenger bundle. Open a command console, enter your project directory and execute the
following command:

```bash
$ composer require symfony/messenger
```

This will install the [messenger component](https://symfony.com/doc/current/components/messenger.html) and create the file app/config/packages/messenger.yaml.

In this file you have to add the configuration for the import:

```yaml
transports:
  import_play_record:
    dsn: '%env(YOUR_DSN_TO_THE_QUEUE)%'
    options:
      exchange:
        # configure the exchange following your needs as described in the messenger bundle docs.
      queues:
        nflfastr.import_play_record:
          binding_keys: [ 'nflfastr.import_play_record' ]
  import_roster_record:
    dsn: '%env(YOUR_DSN_TO_THE_QUEUE)%'
    options:
      exchange:
      # configure the exchange following your needs as described in the messenger bundle docs.
    queues:
      nflfastr.import_roster_record:
        binding_keys: [ 'nflfastr.import_roster_record' ]
  

  routing:
    # Bind the bundles messages to the configured queues
    HansPeterOrding\NflFastrSymfonyBundle\Message\PlayByPlayImport\ImportPlayRecordMessage: import_play_record
    HansPeterOrding\NflFastrSymfonyBundle\Message\PlayByPlayImport\ImportRosterRecordMessage: import_roster_record
```

##### Roster import

For step one, open a command console, enter your project directory and execute the
following command to initialize the roster import:

```bash
$ bin/console nflfastr-symfony:import:messenger:initialize-roster-import
```

This will create one `{ImportRosterRecordMessage}`  for every CSV row in the configured queue.

For step two, you can now execute a worker to process all messages:

```bash
$ bin/console messenger:consume nflfastr.import_roster_record --limit=1000
```

You can execute this manually until all messages are consumed or establish a worker managment in your own environment following your needs.
The [symfony docs](https://symfony.com/doc/current/messenger.html#supervisor-configuration) suggest to use the tool supervisor for this, but you can also find your own setup.

##### Play import

For step one, open a command console, enter your project directory and execute the
following command to initialize the roster import:

```bash
$ bin/console nflfastr-symfony:import:messenger:initialize-play-import
```

This will create one `{ImportPlayRecordMessage}` for every CSV row in the configured queue.

You can append the years to be imported, separated by spaces, to only import selected years:

```bash
$ bin/console nflfastr-symfony:import:messenger:initialize-play-import 2018 2019 2020
```

You can also pass options to manipulate the import behaviour:

* `--skip-updates`: Pass this option to skip already imported plays. Otherwise imported plays will be updated with new data. 
  > This affects only the consumption of the messages. Nevertheless the command creates messages for every CSV row.

For step two, you can now execute a worker to process all messages:

```bash
$ bin/console messenger:consume nflfastr.import_play_record --limit=1000
```

You can execute this manually until all messages are consumed or establish a worker managment in your own environment following your needs.
The [symfony docs](https://symfony.com/doc/current/messenger.html#supervisor-configuration) suggest to use the tool supervisor for this, but you can also find your own setup.

### Direct approach

This approach tries to import all data at once. You only need to run one command and wait until everything is processed.

#### Up- and downsides

Upsides:
* Results can be viewed while importing (not only in logs)
* Synchronous
* Easy to setup and use

Downsides:
* Extremely memory intensive
* Automating is complicated/ not possible
* Needs personal backing

#### Instructions to import

##### Roster import

Open a command console, enter your project directory and execute the
following command to start the roster import:

```bash
$ bin/console nflfastr-symfony:import:roster
```

You can append the years to be imported, separated by spaces, to only import selected years:

```bash
$ bin/console nflfastr-symfony:import:roster 2018 2019 2020
```

You can also pass options to manipulate the import behaviour:

* `--interactive`: If this option is set, you will be asked for inputs (e.g. team names). If not, default values will be used.

> IMPORTANT: This command consumes a lot of memory, keep in mind, that it can possibly crash if you don't assign enough memory.

##### Play import

Open a command console, enter your project directory and execute the
following command to start the roster import:

```bash
$ bin/console nflfastr-symfony:import:plays
```

You can append the years to be imported, separated by spaces, to only import selected years:

```bash
$ bin/console nflfastr-symfony:import:roster 2018 2019 2020
```

You can also pass options to manipulate the import behaviour:

* `--skip-updates`: Pass this option to skip already imported plays. Otherwise imported plays will be updated with new data.
* `--limit`: Pass the number of plays to limit the run to. If you also set skip-updates, only updated plays count to the limit.

> IMPORTANT: This command consumes a lot of memory, keep in mind, that it can possibly crash if you don't assign enough memory.

### Experiences and recommended settings

In my local environment I collected some experiences on fiddling around with the different settings.
As this is highly individual and depends on a lot of factors, don't rely on the following information.
It serves just as an example to get a brief feeling of the numbers.

#### Preconditions

* I run a minikube setup with docker containers
* I assigned 1G of memory to each of my workers
* My setup runs on a Mac Pro from 2016 with 2,2 GHz processors and 32G RAM

#### Findings

* The messenger consumes about 5000 messages in average before it crashes by exceeding memory
* It takes about 10 minutes to consume these 5000 messages
* Importing one gameday takes about 3 minutes
* Importing one season takes less than an hour

I am very curious to hear about your settings and findings: [bjoern.may@gmail.com](mailto:bjoern.may@gmail.com).
