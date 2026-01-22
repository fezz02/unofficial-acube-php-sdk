<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\ApiConfiguration\Requests;

use Fezz\Acube\Sdk\Italy\ApiConfiguration\Dto\ApiConfigurationDto;
use Fezz\Acube\Sdk\Italy\ApiConfiguration\Dto\GetApiConfigurationsRequestDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for listing API configurations.
 *
 * This request sends a GET request to retrieve a collection of API configurations
 * with optional query parameters for filtering and pagination.
 *
 * Endpoint: GET /api-configurations
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/
 */
final class ListApiConfigurationsRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new list API configurations request.
     *
     * @param  GetApiConfigurationsRequestDto  $data  The request data including optional query parameters
     */
    public function __construct(
        public readonly GetApiConfigurationsRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return '/api-configurations';
    }

    /**
     * Create DTOs from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return array<int, ApiConfigurationDto> The response DTOs containing the list of API configurations
     */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<int, array<string, mixed>> $json */
        $json = $response->json();

        return array_map(
            ApiConfigurationDto::from(...),
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

        if ($this->data->business_registry_configurations_fiscal_id !== null) {
            $query['business_registry_configurations.fiscal_id'] = $this->data->business_registry_configurations_fiscal_id;
        }

        if ($this->data->business_registry_configurations_fiscal_id_array !== null) {
            $query['business_registry_configurations.fiscal_id[]'] = $this->data->business_registry_configurations_fiscal_id_array;
        }

        if ($this->data->target_url !== null) {
            $query['target_url'] = $this->data->target_url;
        }

        if ($this->data->page !== null) {
            $query['page'] = $this->data->page;
        }

        if ($this->data->itemsPerPage !== null) {
            $query['itemsPerPage'] = $this->data->itemsPerPage;
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
