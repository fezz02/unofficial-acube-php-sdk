<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests;

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\BusinessRegistryDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\GetBusinessRegistriesRequestDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for listing Business Registry entries.
 *
 * This request sends a GET request to retrieve a collection of business registry entries
 * with optional query parameters for filtering and pagination.
 *
 * Endpoint: GET /business-registries
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry/
 */
final class GetBusinessRegistriesRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get business registries request.
     *
     * @param  GetBusinessRegistriesRequestDto  $data  The request data including optional query parameters
     */
    public function __construct(
        public readonly GetBusinessRegistriesRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return '/business-registries';
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return array<int, BusinessRegistryDto> The response DTO containing the list of business registries
     */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<int, array<string, mixed>> $json */
        $json = $response->json();

        return array_map(
            BusinessRegistryDto::from(...),
            $json
        );
    }

    /**
     * Get the query parameters for the request.
     *
     * @return array<string, mixed> The query parameters
     */
    protected function defaultQuery(): array
    {
        $query = [];

        if ($this->data->simpleSearch !== null) {
            $query['simpleSearch'] = $this->data->simpleSearch;
        }

        if ($this->data->page !== null) {
            $query['page'] = $this->data->page;
        }

        return $query;
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
