<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Requests;

use Fezz\Acube\Sdk\Italy\Invoice\Dto\GetDraftInvoiceRequestDto;
use Fezz\Acube\Sdk\Italy\Invoice\Dto\InvoiceDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for retrieving a single draft invoice by ID.
 *
 * This request sends a GET request to retrieve a specific draft invoice by its ID.
 *
 * Endpoint: GET /invoices/draft/{id}
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final class GetDraftInvoiceRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get draft invoice request.
     *
     * @param  GetDraftInvoiceRequestDto  $data  The request data including ID
     */
    public function __construct(
        public readonly GetDraftInvoiceRequestDto $data
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
     * @return InvoiceDto The response DTO containing the draft invoice data
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
