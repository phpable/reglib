## Introduction
The lightweight library provides a standardized way to use regular expressions 
in php including the most popular prepared templates.  


## Requirements
* PHP >= 7.2.0
* [Able/Statics](https://github.com/phpable/statics)
* [Able/Helpers](https://github.com/phpable/helpers)

## Install
Here's the simpler way to install the Able/Reglib package via [composer](http://getcomposer.org):

```bash
composer require able/reglib
```

## Usage
Now you can use library features anywhere in the code:

```php
use \Able\Reglib;
$Regexp = new Regexp('/vendor/');
echo $Regexp->replace('vendor/reglib', 'able'));

//> able/reglib
```

Or 

```php
use \Able\Reglib;
$Regexp = new Regexp('/^[A-Za-z]+/');
echo $Regexp->take('winter is coming'));

//> winter
```

## License
This package is released under the [MIT license](https://github.com/phpable/reglib/blob/master/LICENSE).
