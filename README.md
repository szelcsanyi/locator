# Hive Locator


Array locator, Version 1.0.0-dev

 1. The locator is a library for finding items in an array by their name.
 2. Allow you to then access that item by the map you define
 3. Allow you to access the full array by maps
 4. Allow you to access other items with in the array by relative location
 5. Allow you to access items through alias functions.
 6. Use what ever method you want to determine whether an item resolves.

What does that actualy mean?

Honstly, its hard to explain, its going to give you access to an array of items in new and exciting ways.
You are best to have a quick look at the examples below, but generally speaking if i have an array of all the servers environments :

```php
    $map = [
      'production' => [
          'site' => 'domain.com'
          'admin' => 'admin.domain.com'
          'draft' => 'draft.domain.com'
      ]
      'staging' => [
          'site' => 'staging.com.au'
          'admin' => 'admin.staging.com.au'
          'draft' => 'draft.staging.com.au'
      ]
      'development' => [
          'site' => 'domain.vrt'
          'admin' => 'admin.domain.vrt'
          'draft' => 'draft.domain.vrt'
      ]
    ];
    
    $environment->resolve('admin.domain.vrt');

```

I can do things like the following

    1. Whats my current item : $environment->get()
        * $environment->server;     // development
        * $environment->type;       // admin
        * $environment->domain;     // admin.domain.vrt
    2. Get me the staging domain for this item.
        * $environment->staging('domain'); // admin.staging.com.au
    3. Get the the production site domain
        * $environment->production('site')->domain
        * $environment->production('site', 'domain')    :  Alternativly use the parameters to specify a specific object
    4. Use an alias to check my current item
        * if($environment->in('production'))        // false
        * if($environment->is('admin'))             // true


Finally its worth just mentioning all of these names/alias/options are configurable

  * Change the name of the mappings to what ever you want. (server, type, domain)
  * Change the name of the alias (in, is, as);
  * Any depth of array is possible (example is three levels deep)
  * Turn on/off features ie. ensure that items cant be access through magic methods
  * It uses drivers to do the comparison check, included drivers are simple/strict/domains/regular experssions, but you can use your own.
  * Items can be accessed from an object or an static instance.
  * Change the config by extending the classes, or simply sending the contructor your configuration array.

## Documentation

Documentation can be found in from the /docs/index.html file.

## Notes

 * phpUnit is not currently running on the php7 branches, due to the changes in its namespaces.
 * PhpMetrics scores are not currently taking into account phpUnit test or code coverage.
 * There is currently no phpUnitTests
 * Contracts will not be implemented until RC.

## Installation

Recommended installation [through composer](http://getcomposer.org).

```JSON
{
    "require": {
        "hive/locator": "dev-1.0.0"
    }
}
```

Via Composer Command line

```bash
    # Install Composer
    curl -sS https://getcomposer.org/installer | php
    
    # Install the latest version
    composer require hive/locator:dev-1.0.0

```

```php
    // With in your php file, include composers autoloader
    require 'vendor/autoload.php';
```

Via Git

```bash
    # Clone the repo
    cd helloworld.dev
    git clone https://github.com/hive/locator.git .
```

```php
    // With in your php file, include composers autoloader
    require 'hive/locator/include.php';
```

## Overview

The code is split up into the following classes :

1. [Library.php](source/Library.php) : The actual locator library, useful for extending functionality.
2. [Object.php](source/Object.php) : Class for accessing the locator object.
3. [Instance.php](source/Instance.php) : Instance of the object class.

Further to this how items in the array our found is by using drivers located in the [source/Driver](source/Driver) folder, currently supported is :

1. [Simple.php](source/Driver/Simple.php) : Does a simple (case insensitive, whitespace insensitive) comparision.
2. [Strict.php](source/Driver/Strict.php) : Does a strict (case, space and type sensitive) comparision.
3. [Domain.php](source/Driver/Domain.php) : Does a strict (case, space and type sensitive) comparision removing any inconsistencies, ie. www.
4. [Expression.php](source/Driver/Expression.php) :  Does a regular expression comparision.


## Useage
-------
 ```php
    use hive\locator;

    $map = [
        'production'    => [
            'site' =>   'domain.com',
            'admin' =>  'admin.domain.com',
            'draft' =>  'draft.domain.com',
        ],
        'beta'          => [
            'site' =>  'beta.com.au',
            'admin' => 'admin.beta.com.au',
            'draft' => 'draft.beta.com.au',
        ],
        'staging'       => [
            'site' =>  'site.custom.staging.com.au',
            'admin' => 'admin.custom.staging.com.au',
            'draft' => 'draft.custom.staging.com.au',
        ],
        'development'   => [
            'site' =>  'site.vrt',
            'admin' => 'admin.vrt',
            'draft' => 'draft.vrt',
        ]
    ];

    $current = $_SERVER['SERVER_NAME'];

 ```


 Simple Object

 ```php

    // Set out options, ie. what we want to call items, these are actually the default values.
    $options = [
        'legend'    => ['server', 'type', 'domain'],
    ];

    // Create the object
    $environment = new Locator\Object($map, $options);

    // Resolve our current url against the map.
    $environment->resolve($current);

    // Access our current item using object properties and the legend.
    echo $environment->server;
    echo $environment->type;
    echo $environment->domain;

 ```

Accessing other maps
 ```php

    // Create the object
    $environment = new Locator\Object($map, $options);

    // Resolve our current url against the map.
    $environment->resolve('admin.custom.staging.com.au');

    // When we parsed the subject, the library works out ou current 'server' and 'type'.
    // This means we can access the other maps, using these as the default items to look for. ie. relative.
    echo $environment->production()->domain; // because our current subject was found in admin, this will return the production admin domain.

    // Never fear, we can still access the full items values.
    echo $environment->production('draft')->domain

    // Finally you can use the paramters to specify what ever you are looking for.
    // This comes in handly for maps which have more then three levels.
    echo $environment->production('draft', 'admin');

 ```


 Simple Instance
 ```php


    // Creating an instance of the item, allows you to access it statically later.
    Locator\Instance::Environment($map);
    Locator\Instance::Environment()->resolve($current);

    // You can access the items much the same as with the object.
    // This will find the production details which most closely match out resolved subject.
    // ie. if we are on the draft site, it will return the production draft domain.
    Locator\Instance::Environment()->production()->domain;

    // Or specify exactly what you are looking for : ie get the production/admin/domain
    echo Locator\Instance::Environment()->production('admin')->domain;


 ```



Using the config

```php



```

Using the drivers

```php



```

## Advance

The locator library has many more options and features, and we are in the process of creating examples [examples](/examples)


## File Map

The code is split up into the following classes :


1. /tests : folder for any unit testing, currently empty
2. /examples : folder for any examples, currently empty
3. [/docs](/docs) : folder for any documentation
4. [/source](/source) : folder for source code
    1. [Library](source/Library.php) : The actual locator library, useful for extending functionality.
        *  __construct( array $map, array $config )
        * resolve       (string $nameOfSubject)
    2. [Object](source/Object.php) : Class for accessing the locator object.
    3. [Instance](source/Instance.php) : Instance of the object class.
    4. [Exception](source/Exception.php): Folder for any exceptions the object will throw.
        * [BadMethodCall](source/Exception/BadMethodCall.php)
        * [IncompleteLegend](source/Exception/IncompleteLegend.php)
        * [InstanceExists](source/Exception/InstanceExists.php)
        * [InvalidDriver](source/Exception/InvalidDriver.php)
        * [UndefinedMapping](source/Exception/UndefinedMapping.php)
        * [UndefinedProperty](source/Exception/UndefinedProperty.php)
        * [UnresolvedLegend](source/Exception/UnresolvedLegend.php)
    5. Driver : folder for any drivers for comparing
        * [Simple](source/Driver/Simple.php) : Does a simple (case insensitive, whitespace insensitive) comparision.
        * [Strict](source/Driver/Strict.php) : Does a strict (case, space and type sensitive) comparision.
        * [Domain](source/Driver/Domain.php) : Does a strict (case, space and type sensitive) comparision removing any inconsistencies, ie. www.
        * [Expression](source/Driver/Expression.php) :  Does a regular expression comparision.
    6. Contract : folder for any interfaces or abstract classes they implement
        * [Library](source/Contract/Library.php)
        * [Object](source/Contract/Object.php)
        * [Instance](source/Contract/Instance.php)
        * [Driver](source/Contract/Driver.php)

The full API documentation can be found [here](https://hive.github.io/locator/html/phpdox/index.xhtml) or all the documentation can be found [here](https://hive.github.io/locator/)