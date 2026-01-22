<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\Subscriptions\Requests;

use Fezz\Acube\Sdk\Common\Subscriptions\Dto\CreateSubscriptionRequestDto;
use Fezz\Acube\Sdk\Common\Subscriptions\Dto\SubscriptionDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for creating a subscription (admin only).
 *
 * This request sends a POST request to create a new subscription.
 * Requires admin role.
 *
 * Endpoint: POST /admin/subscriptions
 * Base URL: https://common.api.acubeapi.com (production) or https://common-sandbox.api.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/common/subscriptions/
 */
final class CreateSubscriptionRequest extends Request
{
    protected Method $method = Method::POST;

    /**
     * Create a new create subscription request.
     *
     * @param  CreateSubscriptionRequestDto  $data  The subscription data
     */
    public function __construct(
        public readonly CreateSubscriptionRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return '/admin/subscriptions';
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return SubscriptionDto The response DTO containing the created subscription
     */
    public function createDtoFromResponse(Response $response): SubscriptionDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return SubscriptionDto::from($json);
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
            'Content-Type' => 'application/json',
        ];
    }
}
