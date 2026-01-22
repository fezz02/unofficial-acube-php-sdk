<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Requests;

use Fezz\Acube\Sdk\Italy\Invoice\Dto\GetInvoiceAttachmentRequestDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for downloading an invoice attachment.
 *
 * This request sends a GET request to download the index-th attachment of an invoice.
 *
 * Endpoint: GET /invoices/{uuid}/attachments/{index}
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final class GetInvoiceAttachmentRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get invoice attachment request.
     *
     * @param  GetInvoiceAttachmentRequestDto  $data  The request data including UUID and index
     */
    public function __construct(
        public readonly GetInvoiceAttachmentRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/invoices/{$this->data->uuid}/attachments/{$this->data->index}";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return string The attachment file content
     */
    public function createDtoFromResponse(Response $response): string
    {
        return $response->body();
    }

    /**
     * Get the default headers for the request.
     *
     * @return array<string, string> The default headers
     */
    protected function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/octet-stream',
        ];
    }
}
