<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\PreSales\Requests;

use Fezz\Acube\Sdk\Common\PreSales\Dto\GetPreSalesRequestDto;
use Fezz\Acube\Sdk\Common\PreSales\Dto\GetPreSalesResponseDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for retrieving pre-sales.
 *
 * This request sends a GET request to retrieve a collection of pre-sales.
 *
 * Endpoint: GET /pre-sales
 * Base URL: https://common.api.acubeapi.com (production) or https://common-sandbox.api.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/common/pre-sales/
 */
final class GetPreSalesRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get pre-sales request.
     *
     * @param  GetPreSalesRequestDto  $data  The request data including optional query parameters
     */
    public function __construct(
        public readonly GetPreSalesRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return '/pre-sales';
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return GetPreSalesResponseDto The response DTO containing the list of pre-sales
     */
    public function createDtoFromResponse(Response $response): GetPreSalesResponseDto
    {
        /** @var array<int, array<string, mixed>> $json */
        $json = $response->json();

        return GetPreSalesResponseDto::from($json);
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
