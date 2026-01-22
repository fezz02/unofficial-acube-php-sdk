<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Requests;

use Fezz\Acube\Sdk\Italy\Invoice\Dto\GetInvoiceReportRequestDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for getting an invoice report.
 *
 * This request sends a GET request to retrieve an invoice report.
 *
 * Endpoint: GET /invoices/report
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final class GetInvoiceReportRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get invoice report request.
     *
     * @param  GetInvoiceReportRequestDto  $data  The request data including optional query parameters
     */
    public function __construct(
        public readonly GetInvoiceReportRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return '/invoices/report';
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return array<string, mixed>|string The response data (report data or file content)
     */
    public function createDtoFromResponse(Response $response): array|string
    {
        $contentType = $response->header('Content-Type');
        $contentTypeString = '';
        if (is_string($contentType)) {
            $contentTypeString = $contentType;
        } elseif (is_array($contentType) && isset($contentType[0]) && is_string($contentType[0])) {
            $contentTypeString = $contentType[0];
        }

        if ($contentTypeString !== '' && str_contains($contentTypeString, 'application/json')) {
            /** @var array<string, mixed> $json */
            $json = $response->json();

            return $json;
        }

        return $response->body();
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
