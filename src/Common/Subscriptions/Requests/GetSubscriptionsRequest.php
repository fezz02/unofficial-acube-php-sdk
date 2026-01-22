<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\Subscriptions\Requests;

use Fezz\Acube\Sdk\Common\Subscriptions\Dto\GetSubscriptionsRequestDto;
use Fezz\Acube\Sdk\Common\Subscriptions\Dto\GetSubscriptionsResponseDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for retrieving subscriptions.
 *
 * This request sends a GET request to retrieve a collection of subscriptions
 * with optional query parameters for filtering.
 *
 * Endpoint: GET /subscriptions
 * Base URL: https://common.api.acubeapi.com (production) or https://common-sandbox.api.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/common/subscriptions/
 */
final class GetSubscriptionsRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get subscriptions request.
     *
     * @param  GetSubscriptionsRequestDto  $data  The request data including optional query parameters
     */
    public function __construct(
        public readonly GetSubscriptionsRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return '/subscriptions';
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return GetSubscriptionsResponseDto The response DTO containing the list of subscriptions
     */
    public function createDtoFromResponse(Response $response): GetSubscriptionsResponseDto
    {
        /** @var array<int, array<string, mixed>> $json */
        $json = $response->json();

        return GetSubscriptionsResponseDto::from($json);
    }

    /**
     * Get the query parameters for the request.
     *
     * @return array<string, mixed> The query parameters
     */
    protected function defaultQuery(): array
    {
        return $this->data->query;
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
