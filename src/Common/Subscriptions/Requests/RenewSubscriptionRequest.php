<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\Subscriptions\Requests;

use Fezz\Acube\Sdk\Common\Subscriptions\Dto\RenewSubscriptionRequestDto;
use Fezz\Acube\Sdk\Common\Subscriptions\Dto\SubscriptionDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for renewing a subscription (admin only).
 *
 * This request sends a POST request to renew or hard-delete a subscription.
 * Requires admin role and should be used by automated processes only.
 *
 * Endpoint: POST /admin/subscriptions/{uuid}/renew
 * Base URL: https://common.api.acubeapi.com (production) or https://common-sandbox.api.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/common/subscriptions/
 */
final class RenewSubscriptionRequest extends Request
{
    protected Method $method = Method::POST;

    /**
     * Create a new renew subscription request.
     *
     * @param  RenewSubscriptionRequestDto  $data  The request data including UUID
     */
    public function __construct(
        public readonly RenewSubscriptionRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/admin/subscriptions/{$this->data->uuid}/renew";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return SubscriptionDto The response DTO containing the renewed subscription
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
