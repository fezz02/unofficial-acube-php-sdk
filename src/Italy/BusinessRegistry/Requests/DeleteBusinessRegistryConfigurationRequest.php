<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Request for deleting a Business Registry Configuration.
 *
 * This request sends a DELETE request to remove a business registry configuration.
 *
 * Endpoint: DELETE /business-registry-configurations/{id}
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry-configuration/
 */
final class DeleteBusinessRegistryConfigurationRequest extends Request
{
    protected Method $method = Method::DELETE;

    /**
     * Create a new delete business registry configuration request.
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
        return "/business-registry-configurations/{$this->id}";
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
