<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\Subscriptions\Requests;

use Fezz\Acube\Sdk\Common\Subscriptions\Dto\SubscriptionDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for retrieving a single subscription by UUID.
 *
 * This request sends a GET request to retrieve a specific subscription by its UUID.
 *
 * Endpoint: GET /subscriptions/{uuid}
 * Base URL: https://common.api.acubeapi.com (production) or https://common-sandbox.api.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/common/subscriptions/
 */
final class GetSubscriptionRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get subscription request.
     *
     * @param  string  $uuid  The subscription UUID
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
        return "/subscriptions/{$this->uuid}";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return SubscriptionDto The response DTO containing the subscription data
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
        ];
    }
}
