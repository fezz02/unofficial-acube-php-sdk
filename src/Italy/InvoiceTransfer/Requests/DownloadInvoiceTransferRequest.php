<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\InvoiceTransfer\Requests;

use Fezz\Acube\Sdk\Italy\InvoiceTransfer\Dto\DownloadInvoiceTransferRequestDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for downloading an invoice transfer file.
 *
 * This request sends a GET request to download an invoice transfer file.
 *
 * Endpoint: GET /invoice-transfers/{id}/download
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoice-transfers/
 */
final class DownloadInvoiceTransferRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new download invoice transfer request.
     *
     * @param  DownloadInvoiceTransferRequestDto  $data  The request data including ID
     */
    public function __construct(
        public readonly DownloadInvoiceTransferRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/invoice-transfers/{$this->data->id}/download";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return string The file content
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
