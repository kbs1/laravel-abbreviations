# Laravel Abbreviations
Simply create human-readable abbreviations / acronyms for any model, or abbreviations / acronyms in general.

In laravel models, use the following trait:
```
use Kbs1\Abbreviations\HasAbbreviation;
```
Now you can get model's abbreviation simply by getting the `$model->abbreviation` attribute.

## Customising the abbreviated attribute
Trait by default uses the `name` attribute of a model. You can override this behavior by overriding the `abbreviationAttribute` function in your model code.

## Generic abbreviations / acronyms
Anywhere in your application, you can call `Abbreviation::make($string)` to generate abbreviations on the fly.