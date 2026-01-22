<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Requests;

use Fezz\Acube\Sdk\Italy\Invoice\Dto\FatturaElettronicaDto;
use Fezz\Acube\Sdk\Italy\Invoice\Dto\SendInvoiceResponseDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Request for sending a standard invoice.
 *
 * This request sends a POST request to submit a FatturaPA invoice in JSON format.
 * The invoice is processed asynchronously and returns a UUID upon successful submission.
 *
 * Endpoint: POST /invoices
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/govit/tag/Invoice/
 */
final class SendInvoiceRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * Create a new send invoice request.
     *
     * @param  FatturaElettronicaDto|array<string, mixed>  $invoice  The invoice data (DTO or array)
     */
    public function __construct(
        public readonly FatturaElettronicaDto|array $invoice
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return '/invoices';
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
     * @return array<string, mixed> The request body containing the invoice data
     */
    protected function defaultBody(): array
    {
        if ($this->invoice instanceof FatturaElettronicaDto) {
            return [
                'fattura_elettronica_header' => $this->invoice->fattura_elettronica_header->all(),
                'fattura_elettronica_body' => array_map(
                    fn (\Fezz\Acube\Sdk\Italy\Invoice\Dto\FatturaElettronicaBodyDto $body): array => $body->all(),
                    $this->invoice->fattura_elettronica_body
                ),
            ];
        }

        return $this->invoice;
    }
}
