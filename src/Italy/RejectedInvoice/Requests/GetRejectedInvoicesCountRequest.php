<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\RejectedInvoice\Requests;

use Fezz\Acube\Sdk\Italy\RejectedInvoice\Dto\GetRejectedInvoicesCountRequestDto;
use Fezz\Acube\Sdk\Italy\RejectedInvoice\Dto\RejectedInvoicesCountDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for getting the count of recoverable rejected invoices.
 *
 * This request sends a GET request to retrieve the count of rejected invoices
 * that can be recovered within a date range.
 *
 * Endpoint: GET /rejected-invoices/{fiscalId}/count
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/rejected-invoices/
 */
final class GetRejectedInvoicesCountRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get rejected invoices count request.
     *
     * @param  GetRejectedInvoicesCountRequestDto  $data  The request data including fiscal ID and query parameters
     */
    public function __construct(
        public readonly GetRejectedInvoicesCountRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/rejected-invoices/{$this->data->fiscal_id}/count";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return RejectedInvoicesCountDto The response DTO containing the count
     */
    public function createDtoFromResponse(Response $response): RejectedInvoicesCountDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return RejectedInvoicesCountDto::from($json);
    }

    /**
     * Get the query parameters for the request.
     *
     * @return array<string, mixed> The query parameters
     */
    protected function defaultQuery(): array
    {
        $query = [];
        if ($this->data->from_date !== null) {
            $query['from_date'] = $this->data->from_date;
        }
        if ($this->data->to_date !== null) {
            $query['to_date'] = $this->data->to_date;
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
