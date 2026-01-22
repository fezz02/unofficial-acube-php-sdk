<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk;

use Fezz\Acube\Sdk\Common\CommonConnector;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Contracts\ProvidesAccount;
use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Saloon\Contracts\Authenticator;
use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

/**
 * Base connector class for A-Cube API integrations.
 *
 * This abstract class provides the foundation for all A-Cube API connectors,
 * handling authentication, token caching, and endpoint configuration.
 *
 * The A-Cube API uses a simple token-based authentication system where:
 * - Users authenticate with email and password via the `/login` endpoint
 * - The API returns a JWT token that must be included in subsequent requests
 * - Tokens do not have explicit refresh tokens or expiration handling
 *
 * @see https://docs.acubeapi.com/documentation/common/authentication/
 *
 * @method static CommonConnector common() Create a Common API connector instance
 * @method static ItalyConnector italy() Create an Italy API connector instance
 * @method static \Fezz\Acube\Sdk\Authentication\Dto\AuthenticationUsefulInformationDto login(string $email, string $password) Authenticate with email and password
 */
abstract class AcubeApi extends Connector
{
    use AlwaysThrowOnErrors;

    public function __construct(
        private readonly Endpoint $endpoint,
        private readonly ?ProvidesAccount $providesAccount = null
    ) {}

    /**
     * Create a new CommonConnector instance.
     *
     * The Common API provides endpoints for authentication, user management,
     * and other common operations across A-Cube services.
     *
     * @return CommonConnector A new Common API connector instance
     *
     * @see https://docs.acubeapi.com/documentation/common/
     */
    public static function common(
        Endpoint $endpoint = Endpoint::COMMON_SANDBOX,
        ?ProvidesAccount $providesAccount = null,
    ): CommonConnector {
        return new CommonConnector($endpoint, $providesAccount);
    }

    /**
     * Create a new ItalyConnector instance.
     *
     * The Italy API provides endpoints specific to Italian e-invoicing operations,
     * including SDI (Sistema di Interscambio) integration and Italian tax compliance.
     *
     * @return ItalyConnector A new Italy API connector instance
     *
     * @see https://docs.acubeapi.com/documentation/gov-it/
     */
    public static function italy(
        Endpoint $endpoint = Endpoint::ITALY_SANDBOX,
        ?ProvidesAccount $providesAccount = null,
    ): ItalyConnector {
        return new ItalyConnector($endpoint, $providesAccount);
    }

    /**
     * Resolve the base URL for API requests.
     *
     * Returns the configured endpoint URL.
     *
     * @return string The base URL for API requests
     */
    public function resolveBaseUrl(): string
    {
        return $this->endpoint->value;
    }

    public function defaultAuth(): ?Authenticator
    {
        return $this->providesAccount?->getAuthenticator();
    }
}
