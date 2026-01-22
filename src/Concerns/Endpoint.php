<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Concerns;

use Fezz\Acube\Sdk\Contracts\Labellable;

/**
 * Enumeration of A-Cube API endpoints.
 *
 * This enum defines the base URLs for different A-Cube API services
 * in both production and sandbox environments.
 *
 * @see https://docs.acubeapi.com/
 */
enum Endpoint: string implements Labellable
{
    /**
     * Common Management API production endpoint.
     *
     * Base URL: https://common.api.acubeapi.com
     *
     * @see https://docs.acubeapi.com/documentation/common/
     */
    case COMMON_PRODUCTION = 'https://common.api.acubeapi.com';

    /**
     * Common Management API sandbox endpoint.
     *
     * Base URL: https://common-sandbox.api.acubeapi.com
     *
     * @see https://docs.acubeapi.com/documentation/common/
     */
    case COMMON_SANDBOX = 'https://common-sandbox.api.acubeapi.com';

    /**
     * Italy API production endpoint.
     *
     * Base URL: https://api.acubeapi.com
     */
    case ITALY_PRODUCTION = 'https://api.acubeapi.com';

    /**
     * Italy API sandbox endpoint.
     *
     * Base URL: https://api-sandbox.acubeapi.com
     */
    case ITALY_SANDBOX = 'https://api-sandbox.acubeapi.com';

    /**
     * Check if an endpoint is a sandbox endpoint.
     *
     * @param  self  $endpoint  The endpoint to check
     * @return bool True if the endpoint is a sandbox endpoint, false otherwise
     */
    public static function isSandbox(self $endpoint): bool
    {
        return match ($endpoint) {
            self::COMMON_SANDBOX, self::ITALY_SANDBOX => true,
            default => false
        };
    }

    /**
     * Extract the hostname from an endpoint URL.
     *
     * @param  Endpoint  $endpoint  The endpoint
     * @return string The hostname without the protocol prefix
     */
    public static function host(Endpoint $endpoint): string
    {
        return str_replace('https://', '', $endpoint->value);
    }

    /**
     * Get the label for this endpoint.
     */
    public function label(): string
    {
        return match ($this) {
            self::COMMON_PRODUCTION => 'Common API - Production',
            self::COMMON_SANDBOX => 'Common API - Sandbox',
            self::ITALY_PRODUCTION => 'Italy API - Production',
            self::ITALY_SANDBOX => 'Italy API - Sandbox',
        };
    }
}
