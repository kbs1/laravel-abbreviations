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
generated abbreviations case (`uppercase`, `lowercase` or `original`), and whether you prefer to include digits in generated abbreviations (default `false`).

See comments in published configuration file for further details.
