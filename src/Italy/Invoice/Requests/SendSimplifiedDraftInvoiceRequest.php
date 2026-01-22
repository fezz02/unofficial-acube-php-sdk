<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Requests;

use Fezz\Acube\Sdk\Italy\Invoice\Dto\InvoiceDto;
use Fezz\Acube\Sdk\Italy\Invoice\Dto\SendSimplifiedDraftInvoiceRequestDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for sending a simplified draft invoice.
 *
 * This request sends a POST request to accept and send a simplified draft invoice to the SDI.
 * The invoice will be validated and sent to the SDI.
 *
 * Endpoint: POST /invoices/simplified/draft/{id}/send
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final class SendSimplifiedDraftInvoiceRequest extends Request
{
    protected Method $method = Method::POST;

    /**
     * Create a new send simplified draft invoice request.
     *
     * @param  SendSimplifiedDraftInvoiceRequestDto  $data  The request data including ID
     */
    public function __construct(
        public readonly SendSimplifiedDraftInvoiceRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/invoices/simplified/draft/{$this->data->id}/send";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return InvoiceDto The response DTO containing the sent invoice
     */
    public function createDtoFromResponse(Response $response): InvoiceDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return InvoiceDto::from($json);
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
