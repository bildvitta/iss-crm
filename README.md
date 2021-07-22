# This is my package IssCrm

[![Latest Version on Packagist](https://img.shields.io/packagist/v/bildvitta/iss-crm.svg?style=flat-square)](https://packagist.org/packages/bildvitta/iss-crm)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/bildvitta/iss-crm/Check%20&%20fix%20styling?label=code%20style)](https://github.com/bildvitta/iss-crm/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/bildvitta/iss-crm.svg?style=flat-square)](https://packagist.org/packages/bildvitta/iss-crm)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us

- Customers (paginate, find).

## Installation

You can install the package via composer:

```bash
composer require bildvitta/iss-crm
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Bildvitta\IssCrm\IssCrmServiceProvider" --tag="iss-crm-config"
```

This is the contents of the published config file:

```php
return [

    'base_uri' => env('MS_CRM_BASE_URI', 'https://api.almobi.com.br'),

    'prefix' => env('MS_CRM_API_PREFIX', '/api')
];

```

## Config

In your .env file, associate the following variables.

````dotenv
# API base URL.
MS_CRM_BASE_URI="http://127.0.0.1:8001"

# API prefix if it exists.
MS_CRM_API_PREFIX="/api"
````

## Usage

```php
$issCrm = new \Bildvitta\IssCrm('jwt-hub');

$issCrm->customers()->search();
print_r($issCrm->customer()->find('uuid'));
```

This is result:

`````json
{
    "result": {
        "uuid": "effe4b02-f2eb-4ee0-9dbc-0d94ed30e532",
        "name": "Dr. Elias Artur Ferminiano",
        "phone": "(51) 90172-3741",
        "phone2": null,
        "email": "daniella52@example.org",
        "document": "683.387.679-72",
        "birthday": "1983-01-23",
        "...": "..."
    }
}
`````

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [BILD\jean.garcia](https://github.com/SOSTheBlack)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
