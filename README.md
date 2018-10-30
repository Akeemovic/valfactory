hublint/valfactory
===========

Simple PHP vaidation library.

- Lightweight.
- No dependencies.
- Suppports multiple validations on a single entity with less code.
- Errors are stored in a single array which can be parsed as JSON or other suitable format for different use cases.

It's simple, and lets you validate inputs/data in three steps.
1. Collect Data.
2. Run Validations.
3. Check for Errors.

ValFactory does NOT care how you collect your data, it only makes sure the data are what you're expecting, before you decide what to do with them.

ValFactory does NOT encrypt, authorize, or authenticate, it's a factory that only validates.

Happy Validating!

## Example

```php
<?php
/**
 * @var Composer\Autoload\ClassLoader $autoload
*/
$autoload = require 'vendor/autoload.php';


// Basic Example

$val = new \Hublint\ValFactory\Validator();

// Test Data
$num = 1233455;
$alphanum = "Hello 123";
$text = 'Hello Dolly';
$email = 'you@mail.com';
$password = 'secret';
$passwordConfirm = 'secret';

// This may be also be an array of emails from the database.
$existingEmails = ['akeemovic@slackwave.net', 'halayindex@slackwave.net'];

/**
 * Format
 * $val->validate('key1', $data1)->valMethod1();
 * $val->validate('key2', $data2)->valMethod2()->valMethod3();
*/

// Run Validations
$val->validate('alphanum', $alphanum)->notEmpty()->alphaNum()->noWhiteSpace()->limitMin(10);
$val->validate('text', $text)->notEmpty()->alpha()->noWhiteSpace()->limitMax(10);
$val->validate('number', $num)->notEmpty()->numeric()->limit(5, 10);
$val->validate('email', $email)->email()->unique($existingEmails, "We won't take that Email");
$val->validate('password', $password)->notEmpty()->noWhiteSpace();
$val->validate('password_confirmation', $passwordConfirm)->sameAs($password);

// Check for errors
if ($val->passed()) {
	echo "Hurray!";
} else {
	foreach($val->errors as $error){
		echo $error . '<br>';
	}
}

// The following produces the same results as the above
if ($val->failed()) {
	foreach($val->errors as $error){
		echo $error . '<br>';
	}
} else {
	echo "Hurray!";
}

/*
 * If validation(s) passed successsfully, $val->failed() returns FALSE, $val->errors returns [] - an empty array.
 * If validation(s) passed successsfully, $val->passed() rerurns TRUE, $val->errors returns [] - an empty array.
 *
 * But,
 *
 * If the validations failed, $val->failed() returns TRUE, $val->errors returns an array of errors.
 * If the validations failed, $val->passed() rerurns FALSE, $val->errors returns an array of errors.
*/
```

## Available Methods
```php
<?php
/**
 * Available Methods
 * $customErrorMessage is for setting custom errros, and is optional. 
 * So, only set it when you don't want the default errors. 
*/

// Validation not empty
notEmpty($customErrorMessage);

// Alphabets Only
alpha($customErrorMessage);

// Numeric values only
numeric($customErrorMessage);

// Alphanumeric characters only
alphaNum($customErrorMessage);

// Must not contain white space
noWhiteSpace($customErrorMessage);

// Validate email
email($customErrorMessage);

// Checks for uniqueness of data in correspondence to $haystack
unique($haystack, $customErrorMessage);

// Validate with your own RegExp pattern
matchPattern($customPattern, $customErrorMessage);

// Validate data is same as $matchingValue
sameAs($matchingValue, $customErrorMessage);

// Set minimmum and maximmum limits
limit($minCount, $maxCount, $customErrorMessage);

// Set minimmum limit
limitMin($minCount, $customErrorMessage);

// Set maximmum limit
limitMax($maxCount, $customErrorMessage);


/** 
 * NOTE: Validation methods must be chained to one validate('key', $data) root method.
 * Example;
 * $val->validate('key', $data)->limit(5, 15);
 * $val->validate('key', $data)->alpha('Characters must be only alphabets Aa-Zz')->noWhiteSpace(5, 15);
*/

```

## installation

Minimmum requirement is PHP 5.4.x. Although, ValFactory might work on lower versions of PHP, they are currently neither tested nor recommended.

### via composer.json:
```json
{
    "require": {
        "hublint/valfactory": "*"
    }
}
```

and then

```bash
composer install
```

or
```bash
composer update -o
```

### via command line
```bash
composer require hublint/valfactory
```
