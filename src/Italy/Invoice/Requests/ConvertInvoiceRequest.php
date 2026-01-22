<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Requests;

use Fezz\Acube\Sdk\Italy\Invoice\Dto\ConvertInvoiceRequestDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Request for converting an invoice between formats.
 *
 * This request sends a POST request to convert an invoice between JSON and XML formats.
 * Sending Content-Type: application/json returns XML, sending Content-Type: application/xml returns JSON.
 *
 * Endpoint: POST /invoices/convert
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final class ConvertInvoiceRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * Create a new convert invoice request.
     *
     * @param  ConvertInvoiceRequestDto  $data  The request data including invoice data
     */
    public function __construct(
        public readonly ConvertInvoiceRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return '/invoices/convert';
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return string The converted invoice (XML or JSON string)
     */
    public function createDtoFromResponse(Response $response): string
    {
        return $response->body();
    }

    /**
     * Get the default body for the request.
     *
     * @return string|array<string, mixed> The request body containing the invoice data
     */
    protected function defaultBody(): string|array
    {
        return $this->data->invoice;
    }

    /**
     * Get the default headers for the request.
     *
     * @return array<string, string> The default headers
     */
    protected function defaultHeaders(): array
    {
        $headers = ['Accept' => 'application/json'];

        // Determine Content-Type based on input type
        $headers['Content-Type'] = is_array($this->data->invoice) ? 'application/json' : 'application/xml';

        return $headers;
    }
}
