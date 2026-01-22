<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Request for resetting legal storage portal password.
 *
 * This request sends a GET request to reset the legal storage portal password
 * for a business registry configuration.
 *
 * Endpoint: GET /business-registry-configurations/{id}/reset-legal-storage-password
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry-configuration/
 */
final class ResetLegalStoragePasswordRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new reset legal storage password request.
     *
     * @param  string  $id  The fiscal identifier of the Business Registry Configuration
     */
    public function __construct(
        public readonly string $id
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/business-registry-configurations/{$this->id}/reset-legal-storage-password";
    }

    /**
     * Get the default headers for the request.
     *
     * @return array<string, string> The default headers
     */
    protected function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
        ];
    }
}
