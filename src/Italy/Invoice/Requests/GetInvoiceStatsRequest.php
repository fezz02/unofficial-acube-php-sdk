<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Requests;

use Fezz\Acube\Sdk\Italy\Invoice\Dto\GetInvoiceStatsRequestDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for getting invoice statistics.
 *
 * This request sends a GET request to retrieve invoice statistics for a specific year.
 *
 * Endpoint: GET /invoices/stats/{year}
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final class GetInvoiceStatsRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get invoice stats request.
     *
     * @param  GetInvoiceStatsRequestDto  $data  The request data including year and optional fiscal_id
     */
    public function __construct(
        public readonly GetInvoiceStatsRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/invoices/stats/{$this->data->year}";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return array<string, mixed> The response data (invoice statistics)
     */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return $json;
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
