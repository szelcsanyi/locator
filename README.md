# Hive Locator
[![Latest Stable Version](https://poser.pugx.org/hive/Locator/v/stable?format=flat-square)](https://packagist.org/packages/hive/locator)
[![Latest Unstable Version](https://poser.pugx.org/hive/Locator/v/unstable?format=flat-square)](https://packagist.org/packages/hive/locator)
[![License](https://poser.pugx.org/hive/Locator/license?format=flat-square)](https://packagist.org/packages/hive/locator)
[![composer.lock](https://poser.pugx.org/hive/Locator/composerlock?format=flat-square)](https://packagist.org/packages/hive/locator)


Array Locator, Version 1.0 currently being developed

## Notes


Version 1.0 Outstanding Items 
 * 

## Installation

Recommended installation [through composer](http://getcomposer.org).

```JSON
{
    "require": {
        "hive/Locator": "dev-master"
    }
}
```

Via Composer Command line

```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php

# Install the latest version
composer require hive/Locator

```

```php
// With in your php file, include composers autoloader
require 'vendor/autoload.php';
```

Via Git

```bash
# Clone the repo
cd helloworld.dev
git clone https://github.com/hive/Locator.git . 
```

```php
// With in your php file, include composers autoloader
require 'hive/Locator/include.php';
```

## Overview

The code is split up into the following classes : 

1. Library.php : The actual benchmarking library, useful for extending functionality.
2. Object.php : Class for accessing the benchmark object.
3. Instance.php : Instance of the object class.

## Useage
-------
 ```php
    use hive\Locator;
 ```
 
