## Introduction
The lightweight library provides a standardized way to use regular expressions 
in php including the most popular prepared templates.  


## Requirements
* PHP >= 7.4.0
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
$Regex = new Regex('/vendor/');
echo $Regex->replace('vendor/reglib', 'able'));

//> able/reglib
```

Or 

```php
use \Able\Reglib;
$Regex = new Regex('/^[A-Za-z]+/');
echo $Regex->take('winter is coming'));

//> winter
```

## License
This package is released under the [MIT license](https://github.com/phpable/reglib/blob/master/LICENSE).
