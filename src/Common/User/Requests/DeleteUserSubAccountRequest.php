<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\User\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Request for deleting a user sub-account.
 *
 * This request sends a DELETE request to remove a sub-account.
 *
 * Endpoint: DELETE /users/me/accounts/{id}
 * Base URL: https://common.api.acubeapi.com (production) or https://common-sandbox.api.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/common/user/
 */
final class DeleteUserSubAccountRequest extends Request
{
    protected Method $method = Method::DELETE;

    /**
     * Create a new delete sub-account request.
     *
     * @param  string  $id  The sub-account ID
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
        return "/users/me/accounts/{$this->id}";
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
