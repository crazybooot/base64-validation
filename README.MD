Laravel validators for base64 encoded files, includes versions of laravel files validation for base64 encoded files.

## Requirements

* PHP: 7.1+/8.0+
* Laravel: 5.5+/6+/7+/8+

## Install

* Install composer package to your laravel project
``` bash
$ composer require crazybooot/base64-validation
```

## Using
Use base64 validation rules as usual Laravel validation rules. Base64 rules variants supports all parameters from their original Laravel rules.
 ```php
public function rules(): array
{
    return [
        'attachment' => 'sometimes|base64dimensions:min_width=100,min_height=200',
    ];
}
```
## Available rules
| base64 rule          | analog of Laravel rule|
|:---------------------|:----------------------|
| base64max            | max (for file)        |
| base64min            | min (for file)        |
| base64dimensions     | dimensions (for image)|
| base64file           | file                  |
| base64image          | image                 |
| base64mimetypes      | mimetypes             |
| base64mimes          | mimes                 |
| base64between        | between (for file)    |
| base64size           | size (for file)       |

## Localization
By default each base64 rule uses validation error message
from its non base64 file rule equivalent, for example localization from 'validation.min.file'
is used for base64min message.
If you would like to have your own localization for base64 rules you can easy change default behaviour
by publishing config
```bash
php artisan vendor:publish --provider="Crazybooot\Base64Validation\Providers\ServiceProvider" --tag=config
```
and setting up `replace_validation_messages` option to `false` on config/base64validation.php file, 
and add localizations for rules in standard Laravel way.

## License

The MIT License (MIT). Please see [License File](LICENSE.MD) for more information.






