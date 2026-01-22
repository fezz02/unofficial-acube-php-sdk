<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\ApiConfiguration\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Request for deleting an API configuration.
 *
 * Endpoint: DELETE /api-configurations/{id}
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/
 */
final class DeleteApiConfigurationRequest extends Request
{
    protected Method $method = Method::DELETE;

    /**
     * Create a new delete API configuration request.
     *
     * @param  string  $id  The API configuration UUID
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
        return "/api-configurations/{$this->id}";
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
