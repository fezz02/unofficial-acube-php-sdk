<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\InvoiceExtract\Requests;

use Fezz\Acube\Sdk\Italy\InvoiceExtract\Dto\GetInvoiceExtractResultRequestDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Request for retrieving the result of an invoice extract job.
 *
 * This request sends a GET request to retrieve the extracted invoice in XML or JSON format.
 *
 * Endpoint: GET /invoice-extract/{uuid}/result
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoice-extract/
 */
final class GetInvoiceExtractResultRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get invoice extract result request.
     *
     * @param  GetInvoiceExtractResultRequestDto  $data  The request data including UUID and format
     */
    public function __construct(
        public readonly GetInvoiceExtractResultRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/invoice-extract/{$this->data->uuid}/result";
    }

    /**
     * Get the default headers for the request.
     *
     * @return array<string, string> The default headers
     */
    protected function defaultHeaders(): array
    {
        $accept = $this->data->format === 'xml' ? 'application/xml' : 'application/json';

        return [
            'Accept' => $accept,
        ];
    }
}
