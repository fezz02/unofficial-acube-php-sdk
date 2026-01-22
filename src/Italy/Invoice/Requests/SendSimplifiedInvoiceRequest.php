<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Requests;

use Fezz\Acube\Sdk\Italy\Invoice\Dto\FatturaElettronicaSemplificataDto;
use Fezz\Acube\Sdk\Italy\Invoice\Dto\SendInvoiceResponseDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Request for sending a simplified invoice.
 *
 * This request sends a POST request to submit a simplified FatturaPA invoice
 * in JSON format. Simplified invoices are used for invoices with total ≤ 400€.
 *
 * Endpoint: POST /invoices/simplified
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final class SendSimplifiedInvoiceRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * Create a new send simplified invoice request.
     *
     * @param  FatturaElettronicaSemplificataDto|array<string, mixed>  $invoice  The simplified invoice data (DTO or array)
     */
    public function __construct(
        public readonly FatturaElettronicaSemplificataDto|array $invoice
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return '/invoices/simplified';
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return SendInvoiceResponseDto The response DTO containing the invoice UUID
     */
    public function createDtoFromResponse(Response $response): SendInvoiceResponseDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return SendInvoiceResponseDto::from($json);
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

    /**
     * Get the default body for the request.
     *
     * @return array<string, mixed> The request body containing the simplified invoice data
     */
    protected function defaultBody(): array
    {
        if ($this->invoice instanceof FatturaElettronicaSemplificataDto) {
            return [
                'fattura_elettronica_header' => $this->invoice->fattura_elettronica_header,
                'fattura_elettronica_body' => $this->invoice->fattura_elettronica_body,
            ];
        }

        return $this->invoice;
    }
}
