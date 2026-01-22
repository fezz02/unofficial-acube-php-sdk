<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Requests;

use Fezz\Acube\Sdk\Italy\Invoice\Dto\FatturaElettronicaSemplificataDto;
use Fezz\Acube\Sdk\Italy\Invoice\Dto\ValidateSimplifiedInvoiceRequestDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Request for validating a simplified invoice.
 *
 * This request sends a POST request to validate a simplified invoice without sending it to the SDI.
 *
 * Endpoint: POST /invoices/simplified/validate
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final class ValidateSimplifiedInvoiceRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * Create a new validate simplified invoice request.
     *
     * @param  ValidateSimplifiedInvoiceRequestDto  $data  The request data including invoice data
     */
    public function __construct(
        public readonly ValidateSimplifiedInvoiceRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return '/invoices/simplified/validate';
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return array<string, mixed> The response data (validation result)
     */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return $json;
    }

    /**
     * Get the default body for the request.
     *
     * @return array<string, mixed> The request body containing the invoice data
     */
    protected function defaultBody(): array
    {
        $invoice = $this->data->invoice;

        if ($invoice instanceof FatturaElettronicaSemplificataDto) {
            return $invoice->all();
        }

        return $invoice;
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
            'Content-Type' => 'application/json',
        ];
    }
}
