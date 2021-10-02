# jrmajor/pluralrules

<a href="https://packagist.org/packages/jrmajor/pluralrules"><img src="https://img.shields.io/packagist/v/jrmajor/pluralrules.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/jrmajor/pluralrules"><img src="https://img.shields.io/packagist/php-v/jrmajor/pluralrules.svg" alt="Required PHP Version"></a>

A PHP package for identifying the plural category, according to [CLDR](https://github.com/unicode-cldr/cldr-core/blob/master/supplemental/plurals.json), for a given number.

```php
Major\PluralRules\PluralRules::select('pl', 42); // 'few'
```

You may install it via composer: `composer require jrmajor/pluralrules`. It requires PHP 8.0 or higher.

## Compiling rules

Download plural rules in JSON format from CLDR repository to `data/plurals.json`:

```sh
curl https://raw.githubusercontent.com/unicode-org/cldr-json/master/cldr-json/cldr-core/supplemental/plurals.json -o data/plurals.json
```

Run `composer make` to compile rules.

## Testing

```sh
vendor/bin/pest              # Tests
vendor/bin/phpstan analyse   # Static analysis
vendor/bin/php-cs-fixer fix  # Formatting
```
