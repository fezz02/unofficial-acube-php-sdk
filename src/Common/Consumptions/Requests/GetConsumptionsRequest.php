<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\Consumptions\Requests;

use Fezz\Acube\Sdk\Common\Consumptions\Dto\GetConsumptionsRequestDto;
use Fezz\Acube\Sdk\Common\Consumptions\Dto\GetConsumptionsResponseDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for listing consumptions.
 *
 * This request sends a GET request to retrieve a collection of consumptions
 * with optional query parameters for filtering by year and month.
 *
 * Endpoint: GET /consumptions
 * Base URL: https://common.api.acubeapi.com (production) or https://common-sandbox.api.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/common/consumptions/
 */
final class GetConsumptionsRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get consumptions request.
     *
     * @param  GetConsumptionsRequestDto  $data  The request data including optional query parameters
     */
    public function __construct(
        public readonly GetConsumptionsRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return '/consumptions';
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return GetConsumptionsResponseDto The response DTO containing the list of consumptions
     */
    public function createDtoFromResponse(Response $response): GetConsumptionsResponseDto
    {
        /** @var array<int, array<string, mixed>> $json */
        $json = $response->json();

        return GetConsumptionsResponseDto::from($json);
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
