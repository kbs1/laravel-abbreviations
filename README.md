# Laravel abbreviations
Simply create human-readable abbreviations / acronyms for any model, or abbreviations / acronyms in general.

## Installation
This package supports auto discovery. For laravel versions &lt; 5.5, add the following line in `config/app.php` providers section:
```
Kbs1\Abbreviations\AbbreviationsServiceProvider::class,
```
Add the following line in `config/app.php` aliases section:
```
'Abbreviation' => Kbs1\Abbreviations\Abbreviation::class,
```

## Usage
In laravel models, use the following trait:
```
use \Kbs1\Abbreviations\HasAbbreviation;
```
Now you can get model's abbreviation simply by getting the `$model->abbreviation` attribute.

## Customising the abbreviated attribute
Trait by default uses the `name` attribute of a model. You can override this behavior by overriding the `abbreviationAttribute` method in your model code.

## Generic abbreviations / acronyms
Anywhere in your application, you can call `Abbreviation::make($string)` or `abbreviate($string)` helper to generate abbreviations on the fly.

## Configuration
After publishing the config with `php artisan vendor:publish --tag=abbreviations`, you can define maximum generated abbreviations length (default `3`),
generated abbreviations case (`uppercase`, `lowercase` or `original`), whether you prefer to include digits in generated abbreviations (default `false`),
and whether to remove existing abbreviations from source string before processing (default `true`).

See comments in published configuration file for further details.

## Examples
Using default configuration:
- `abbreviate('somestring') == 'SOM'`
- `abbreviate('somestring w/meaning') == 'SM'`
- `abbreviate('somestring w/o meaning') == 'SM'`
- `abbreviate('somestring incl. others') == 'SO'`
- `abbreviate('Ing. Name Surname, PhD.') == 'NS'`
- `abbreviate('[7] => somestring') == 'SOM'`
- `abbreviate('K-9 mail widget') == 'KMW'`
- `abbreviate('GPSLoc') == 'GL'`
- `abbreviate('14Logistics internal system') == 'LIS'`
- `abbreviate('#1411: fix fooBar status') == 'FFB'`
- `abbreviate('#1234: deploy') == 'DEP'`
- `abbreviate('#1234:777: 500 words 7 characters long') == 'WCL'`
- `abbreviate('#1234:777: 500 words 700b') == 'WB'`
- `abbreviate('#1234:777: 500') == '#12'`
- `abbreviate('123456abcde') == 'ABC'`

Allowing digits:
- `abbreviate('K-9 mail widget') == 'KMW'` (non digit matching is always preferred)
- `abbreviate('[7] => somestring') == '7S'`
- `abbreviate('#1234: deploy') == '1D'`
- `abbreviate('#1234:777: 500 words 700b') == '175'`
- `abbreviate('#1234:777: 500') == '175'`
- `abbreviate('123456abcde') == '123'`
