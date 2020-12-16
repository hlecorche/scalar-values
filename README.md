# Scalar Values Tools

[![Build Status](https://travis-ci.com/e-commit/scalar-values.svg?branch=master)](https://travis-ci.com/e-commit/scalar-values)

## Installation ##

To install scalar-values with Composer just run :

```bash
$ composer require ecommit/scalar-values
```

## Usage ##

Test if an array contains only scalar values :

```php
use Ecommit\ScalarValues\ScalarValues;

$array = ['str1', 2, 3];
if (ScalarValues::containsOnlyScalarValues($array)) { //True
    //...
} else {
    //...
}

$array = ['str1', ['tab'], 3];
if (ScalarValues::containsOnlyScalarValues($array)) { //False
    //...
} else {
    //...
}
```

Returns the input array after deleting all non-scalar values (on root):

```php
use Ecommit\ScalarValues\ScalarValues;

$array = ['str1', ['tab'], 3];
$newArray = ScalarValues::filterScalarValues($array); //[0 => 'str1', 2 => 3]
```

## License ##

This librairy is under the MIT license. See the complete license in *LICENSE* file.
