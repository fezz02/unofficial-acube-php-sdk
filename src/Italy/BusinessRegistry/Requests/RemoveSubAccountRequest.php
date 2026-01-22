<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests;

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\RemoveSubAccountRequestDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Request for removing a sub account.
 *
 * This request sends a DELETE request to remove a sub account from a business registry configuration.
 *
 * Endpoint: DELETE /business-registry-configurations/{id}/sub-accounts/{email}
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry-configuration/
 */
final class RemoveSubAccountRequest extends Request
{
    protected Method $method = Method::DELETE;

    /**
     * Create a new remove sub account request.
     *
     * @param  RemoveSubAccountRequestDto  $data  The request data including fiscal identifier and email
     */
    public function __construct(
        public readonly RemoveSubAccountRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/business-registry-configurations/{$this->data->id}/sub-accounts/{$this->data->email}";
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
