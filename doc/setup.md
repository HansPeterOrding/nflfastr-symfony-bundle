Setting up the bundle
=====================

Download the Bundle
-------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```bash
$ composer require hans-peter-ording/nflfastr-symfony-bundle
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Enable the Bundle
-----------------

Then, enable the bundle by adding the following line in the `app/AppKernel.php`
file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            // ...
            new HansPeterOrding\NflFastrSymfonyBundle\NflFastrSymfonyBundle(),
        ];

        // ...
    }
}
```

Define data sources
-------------------

NflFastRSymfonyBundle requires a base URL and the path for roster and play by play data each.
If you installed the bundle using the recipes, the default NflFastR sources are already predefined. If NflFastR somehow changes any of the sources, this is the place to adjust it.

You should use the raw versions of the CSV providing source to ensure stream reading.

```yaml
nfl_fastr_symfony:
  sources:
    playByPlay:
      baseUrl: https://raw.githubusercontent.com/guga31bb/nflfastR-data/
      path: master/data/
    roster:
      baseUrl: https://raw.githubusercontent.com/mrcaseb/nflfastR-roster/
      path: master/data/seasons/
```

Apply migrations
----------------

The bundles primarily goal is to make NFL roster and play by play data available in your Symfony app. Knowing this it is self explanatory that you need your database to be capable of this. The bundle comes with complete migration files, that must be mapped in your config:

```yaml
# app/cnnfig/doctrine.yaml
orm:
    naming_strategy: doctrine.orm.naming_strategy.underscore_number_aware
    auto_mapping: true
    mappings:
        NflFastrSymfonyBundle:
            type: xml
            dir: 'Resources/config/doctrine'
            prefix: 'HansPeterOrding\NflFastrSymfonyBundle\Entity'
```

Now the migrations need to be executed. Open a command console, enter your project directory and execute the following command:

```bash
$ bin/console doctrine:migrations:migrate
```

You are now ready to [import NflFastR data](import_strategies.md).
