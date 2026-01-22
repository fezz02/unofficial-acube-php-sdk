<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Requests;

use Fezz\Acube\Sdk\Italy\Invoice\Dto\GetInvoicePreservedDocumentRequestDto;
use Fezz\Acube\Sdk\Italy\PreservedDocument\Dto\PreservedDocumentDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for getting an invoice preserved document.
 *
 * This request sends a GET request to retrieve the preserved document for an invoice.
 *
 * Endpoint: GET /invoices/{id}/preserved-document
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final class GetInvoicePreservedDocumentRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get invoice preserved document request.
     *
     * @param  GetInvoicePreservedDocumentRequestDto  $data  The request data including ID
     */
    public function __construct(
        public readonly GetInvoicePreservedDocumentRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/invoices/{$this->data->id}/preserved-document";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return PreservedDocumentDto The response DTO containing the preserved document data
     */
    public function createDtoFromResponse(Response $response): PreservedDocumentDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return PreservedDocumentDto::from($json);
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
