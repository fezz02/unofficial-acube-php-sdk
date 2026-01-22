<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\Subscriptions\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Request for deleting a subscription (admin only).
 *
 * This request sends a DELETE request to schedule a subscription for deletion.
 * Requires admin role.
 *
 * Endpoint: DELETE /admin/subscriptions/{uuid}
 * Base URL: https://common.api.acubeapi.com (production) or https://common-sandbox.api.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/common/subscriptions/
 */
final class DeleteSubscriptionRequest extends Request
{
    protected Method $method = Method::DELETE;

    /**
     * Create a new delete subscription request.
     *
     * @param  string  $uuid  The UUID of the subscription to delete
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
        return "/admin/subscriptions/{$this->uuid}";
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
