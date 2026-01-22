> **UNOFFICIAL** — This package is not affiliated with, endorsed by, or sponsored by A-Cube.  
> Independent open-source project. Use at your own risk.

<p>
    <a href="https://github.com/fezz02/unofficial-acube-php-sdk/actions"><img src="https://img.shields.io/github/actions/workflow/status/fezz02/unofficial-acube-php-sdk/tests.yml?label=Tests" alt="Build Status"></a>
    <a href="https://www.php.net/"><img src="https://img.shields.io/badge/php-8.3%2B-blue.svg" alt="PHP Version"></a>
</p>

# Unofficial A-Cube PHP SDK

PHP SDK for the A-Cube e-invoicing API. Uses Saloon PHP for HTTP requests and provides type-safe DTOs for requests and responses.

The SDK requires implementing `TokenCache` for token storage and `ProvidesAccount` for authentication. See [docs/laravel.md](docs/laravel.md) for Laravel-specific examples.

## Installation (VCS)

Add to your `composer.json`:

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/fezz02/unofficial-acube-php-sdk"
        }
    ]
}
```

Then:

```bash
composer require fezz/unofficial-acube-php-sdk
```

## Quick Start

**Note:** The example below will not work without implementing `TokenCache` and `ProvidesAccount` first. See [docs/laravel.md](docs/laravel.md) for working examples.

```php
use Fezz\Acube\Sdk\AcubeApi;
use Fezz\Acube\Sdk\Concerns\Endpoint;

// Create connectors (requires ProvidesAccount for authenticated requests)
$italyConnector = AcubeApi::italy(
    endpoint: Endpoint::ITALY_SANDBOX,
    providesAccount: $yourProvidesAccount
);
$commonConnector = AcubeApi::common(
    endpoint: Endpoint::COMMON_SANDBOX,
    providesAccount: $yourProvidesAccount
);

// Use with your ProvidesAccount implementation
$response = $italyConnector->invoices()->list();
```

## Supported APIs

- Common Management API (authentication, users, subscriptions, pre-sales, consumptions)
- Italy e-invoicing API (invoices, receipts, notifications, business registry, legal storage, etc.)

## Out of Scope

- Belgium-related APIs
- Poland-related APIs
- PEPPOL integrations
- Open Banking
- Stripe or other payment providers

## Documentation

- [Laravel Examples](docs/laravel.md) — Laravel-specific implementation examples

## License

MIT License. See [LICENSE.md](LICENSE.md).

## Trademark & Legal

This SDK is an independent open-source project and is not affiliated with, endorsed by, or sponsored by A-Cube. "A-Cube" and related names are trademarks of their respective owners. Use at your own risk.

## Links

- [A-Cube API Documentation](https://docs.acubeapi.com/)
- [GitHub Repository](https://github.com/fezz02/unofficial-acube-php-sdk)
- [Issue Tracker](https://github.com/fezz02/unofficial-acube-php-sdk/issues)
