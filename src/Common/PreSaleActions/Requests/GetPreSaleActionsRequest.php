<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\PreSaleActions\Requests;

use Fezz\Acube\Sdk\Common\PreSaleActions\Dto\GetPreSaleActionsRequestDto;
use Fezz\Acube\Sdk\Common\PreSaleActions\Dto\GetPreSaleActionsResponseDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for retrieving pre-sale actions.
 *
 * This request sends a GET request to retrieve a collection of pre-sale actions.
 *
 * Endpoint: GET /pre-sale-actions
 * Base URL: https://common.api.acubeapi.com (production) or https://common-sandbox.api.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/common/pre-sale-actions/
 */
final class GetPreSaleActionsRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get pre-sale actions request.
     *
     * @param  GetPreSaleActionsRequestDto  $data  The request data including optional query parameters
     */
    public function __construct(
        public readonly GetPreSaleActionsRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return '/pre-sale-actions';
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return GetPreSaleActionsResponseDto The response DTO containing the list of pre-sale actions
     */
    public function createDtoFromResponse(Response $response): GetPreSaleActionsResponseDto
    {
        /** @var array<int, array<string, mixed>> $json */
        $json = $response->json();

        return GetPreSaleActionsResponseDto::from($json);
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
