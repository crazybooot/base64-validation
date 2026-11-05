Laravel validators for base64 encoded files, includes versions of laravel files validation for base64 encoded files.

## Requirements

* PHP: 7.1+/8.0+
* Laravel: 5.5+/6+/7+/8+/9+/10+/11+/12+/13+

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

## Base64 rule examples

Each rule accepts a Base64-encoded string. The package also accepts a data URI such as `data:image/png;base64,...`; the prefix is removed before the content is decoded. These rules check a supplied, non-empty value. Use Laravel rules such as `sometimes` or `nullable` as appropriate for whether the field may be absent or empty.

Rules that measure file size use Laravel's file-size parameters in kilobytes (KB). The examples below use pipe-delimited strings, but the same rules can be used in rule arrays.

### File presence and type

```php
use Illuminate\Support\Facades\Validator;

$validator = Validator::make($request->all(), [
    'attachment' => ['required', 'base64file'],
    'photo' => ['required', 'base64image'],
]);
```

- `base64file` checks that the decoded value is a valid file.
- `base64image` checks that the decoded file is an image.

### File size

```php
$rules = [
    // No larger than 2048 KB (2 MB).
    'attachment' => 'required|base64max:2048',

    // At least 10 KB.
    'archive' => 'required|base64min:10',

    // Between 10 and 2048 KB, inclusive.
    'document' => 'required|base64between:10,2048',

    // Exactly 512 KB.
    'thumbnail' => 'required|base64size:512',
];
```

These rules use the same parameters and file-size semantics as Laravel's `max`, `min`, `between`, and `size` file validation rules.

### Allowed extensions and MIME types

```php
$rules = [
    // Match the file's detected MIME type.
    'attachment' => 'required|base64mimetypes:application/pdf,text/plain',

    // Match file extensions, without a leading dot.
    'image' => 'required|base64mimes:jpg,jpeg,png',
];
```

`base64mimetypes` takes MIME type names; `base64mimes` takes extensions. Both follow the corresponding Laravel rules' parameter conventions.

### Image dimensions

```php
$rules = [
    'avatar' => [
        'required',
        'base64image',
        'base64dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000,ratio=1/1',
    ],
];
```

`base64dimensions` accepts Laravel's `dimensions` parameters, including `width`, `height`, `min_width`, `min_height`, `max_width`, `max_height`, and `ratio`. For example, `ratio=3/2` requires an image whose width-to-height ratio is 3:2.

### Combining rules

As with other Laravel validation rules, combine the package's rules with standard rules and pass parameters as needed:

```php
$rules = [
    'upload' => 'required|base64file|base64mimes:pdf|max:2048',
    'profile_image' => 'required|base64image|base64max:1024|base64dimensions:min_width=300,min_height=300',
];
```

Use the `base64`-prefixed file rules when validating the encoded string. Standard rules such as `required` remain useful, but file-specific Laravel rules like `max` should be replaced with their `base64` equivalents so validation operates on the decoded file.
