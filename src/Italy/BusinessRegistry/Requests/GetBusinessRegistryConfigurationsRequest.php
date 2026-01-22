<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests;

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\BusinessRegistryConfigurationDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\GetBusinessRegistryConfigurationsRequestDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for listing Business Registry Configurations.
 *
 * This request sends a GET request to retrieve a collection of business registry configurations
 * with optional query parameters for filtering and pagination.
 *
 * Endpoint: GET /business-registry-configurations
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry-configuration/
 */
final class GetBusinessRegistryConfigurationsRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get business registry configurations request.
     *
     * @param  GetBusinessRegistryConfigurationsRequestDto  $data  The request data including optional query parameters
     */
    public function __construct(
        public readonly GetBusinessRegistryConfigurationsRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return '/business-registry-configurations';
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return array<int, BusinessRegistryConfigurationDto> The response DTO containing the list of business registry configurations
     */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<int, array<string, mixed>> $json */
        $json = $response->json();

        return array_map(
            BusinessRegistryConfigurationDto::from(...),
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

        if ($this->data->fiscal_id !== null) {
            $query['fiscal_id'] = $this->data->fiscal_id;
        }

        if ($this->data->fiscal_id_array !== null) {
            $query['fiscal_id[]'] = $this->data->fiscal_id_array;
        }

        if ($this->data->email !== null) {
            $query['email'] = $this->data->email;
        }

        if ($this->data->name !== null) {
            $query['name'] = $this->data->name;
        }

        if ($this->data->supplier_invoice_enabled !== null) {
            $query['supplier_invoice_enabled'] = $this->data->supplier_invoice_enabled;
        }

        if ($this->data->apply_signature !== null) {
            $query['apply_signature'] = $this->data->apply_signature;
        }

        if ($this->data->apply_legal_storage !== null) {
            $query['apply_legal_storage'] = $this->data->apply_legal_storage;
        }

        if ($this->data->legal_storage_active !== null) {
            $query['legal_storage_active'] = $this->data->legal_storage_active;
        }

        if ($this->data->receipts_enabled !== null) {
            $query['receipts_enabled'] = $this->data->receipts_enabled;
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
