# jrmajor/pluralrules

<a href="https://packagist.org/packages/jrmajor/pluralrules"><img src="https://img.shields.io/packagist/v/jrmajor/pluralrules.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/jrmajor/pluralrules"><img src="https://img.shields.io/packagist/php-v/jrmajor/pluralrules.svg" alt="Required PHP Version"></a>

A PHP package for identifying the plural category, according to [CLDR](https://github.com/unicode-cldr/cldr-core/blob/master/supplemental/plurals.json), for a given number.

```php
Major\PluralRules\PluralRules::select('pl', 42); // 'few'
```

You may install it via composer: `composer require jrmajor/pluralrules`. It requires PHP 8.0 or higher.

## Contributing

This package works by compiling CLDR plural rules to PHP closures like [these](rules/pl.php).
This is done by `composer make` script.
Before running it, you would need to run `yarn install` to download [`cldr-core`](https://github.com/unicode-org/cldr-json/tree/main/cldr-json/cldr-core) package.

## Testing

```sh
vendor/bin/pest              # Tests
vendor/bin/phpstan analyse   # Static analysis
vendor/bin/php-cs-fixer fix  # Formatting
```
