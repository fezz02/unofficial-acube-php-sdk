<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Requests;

use Fezz\Acube\Sdk\Italy\Invoice\Dto\FatturaElettronicaDto;
use Fezz\Acube\Sdk\Italy\Invoice\Dto\InvoiceDto;
use Fezz\Acube\Sdk\Italy\Invoice\Dto\UpdateDraftInvoiceRequestDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Request for updating a draft invoice.
 *
 * This request sends a PUT request to update the content of a draft invoice.
 *
 * Endpoint: PUT /invoices/draft/{id}
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final class UpdateDraftInvoiceRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    /**
     * Create a new update draft invoice request.
     *
     * @param  UpdateDraftInvoiceRequestDto  $data  The request data including ID and invoice data
     */
    public function __construct(
        public readonly UpdateDraftInvoiceRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/invoices/draft/{$this->data->id}";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return InvoiceDto The response DTO containing the updated draft invoice
     */
    public function createDtoFromResponse(Response $response): InvoiceDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return InvoiceDto::from($json);
    }

    /**
     * Get the default body for the request.
     *
     * @return array<string, mixed> The request body containing the invoice data
     */
    protected function defaultBody(): array
    {
        $invoice = $this->data->invoice;

        if ($invoice instanceof FatturaElettronicaDto) {
            return [
                'fattura_elettronica_header' => $invoice->fattura_elettronica_header->all(),
                'fattura_elettronica_body' => array_map(
                    fn (\Fezz\Acube\Sdk\Italy\Invoice\Dto\FatturaElettronicaBodyDto $body): array => $body->all(),
                    $invoice->fattura_elettronica_body
                ),
            ];
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
