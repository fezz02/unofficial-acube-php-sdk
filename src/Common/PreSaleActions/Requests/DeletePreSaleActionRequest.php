<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\PreSaleActions\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Request for deleting a pre-sale action.
 *
 * This request sends a DELETE request to remove a pre-sale action.
 *
 * Endpoint: DELETE /pre-sale-actions/{uuid}
 * Base URL: https://common.api.acubeapi.com (production) or https://common-sandbox.api.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/common/pre-sale-actions/
 */
final class DeletePreSaleActionRequest extends Request
{
    protected Method $method = Method::DELETE;

    /**
     * Create a new delete pre-sale action request.
     *
     * @param  string  $uuid  The pre-sale action UUID
     */
    public function __construct(
        public readonly string $uuid
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/pre-sale-actions/{$this->uuid}";
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
