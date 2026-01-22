<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Request for deleting a Business Registry entry.
 *
 * This request sends a DELETE request to remove a business registry entry.
 *
 * Endpoint: DELETE /business-registries/{id}
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry/
 */
final class DeleteBusinessRegistryRequest extends Request
{
    protected Method $method = Method::DELETE;

    /**
     * Create a new delete business registry request.
     *
     * @param  string  $id  The ID of the business registry entry
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
        return "/business-registries/{$this->id}";
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
