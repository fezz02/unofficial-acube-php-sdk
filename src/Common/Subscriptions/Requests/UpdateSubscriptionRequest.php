<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\Subscriptions\Requests;

use Fezz\Acube\Sdk\Common\Subscriptions\Dto\SubscriptionDto;
use Fezz\Acube\Sdk\Common\Subscriptions\Dto\UpdateSubscriptionRequestDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for updating a subscription (admin only).
 *
 * This request sends a PUT request to update an existing subscription.
 * Requires admin role.
 *
 * Endpoint: PUT /admin/subscriptions/{uuid}
 * Base URL: https://common.api.acubeapi.com (production) or https://common-sandbox.api.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/common/subscriptions/
 */
final class UpdateSubscriptionRequest extends Request
{
    protected Method $method = Method::PUT;

    /**
     * Create a new update subscription request.
     *
     * @param  UpdateSubscriptionRequestDto  $data  The update data including UUID
     */
    public function __construct(
        public readonly UpdateSubscriptionRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/admin/subscriptions/{$this->data->uuid}";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return SubscriptionDto The response DTO containing the updated subscription
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
