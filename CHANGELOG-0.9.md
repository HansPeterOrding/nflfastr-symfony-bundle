CHANGELOG for 0.9.x
===================

This changelog references the relevant changes (bug and security fixes) done
in 0.9 versions.

### 0.9.1 (2021-05-10)

Features:

* Reflect latest changes from NflfastR:
  * Added 'special' flag
* Add new columns:
  * `{Game.season}`
  * `{Play.playDeleted}`
* Move yard columns to sub-entity `{Yards}`
* Introduce sub-entity `{PlayResults}`
* Allow null for some columns

### 0.9.0 (2021-03-25)

**Hello world! The bundle is born.**

Features:

* Entities that reflect the NflfastR data
* Migrations to create database tables
* Repositories to query those database tables
* Converters that create entities from CSV data
* Different import strategies to match environmental requirements:
  * direct: Import data directly in a console
  * Symfony messenger: Import data using Symfony messenger bundle