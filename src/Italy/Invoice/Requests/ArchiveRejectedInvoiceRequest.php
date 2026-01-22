<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Requests;

use Fezz\Acube\Sdk\Italy\Invoice\Dto\ArchiveRejectedInvoiceRequestDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Request for archiving a rejected invoice.
 *
 * This request sends a PUT request to mark a rejected invoice as archived
 * and remove it from the rejected list to be fixed.
 *
 * Endpoint: PUT /invoices/{id}/archive-rejected
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final class ArchiveRejectedInvoiceRequest extends Request
{
    protected Method $method = Method::PUT;

    /**
     * Create a new archive rejected invoice request.
     *
     * @param  ArchiveRejectedInvoiceRequestDto  $data  The request data including ID
     */
    public function __construct(
        public readonly ArchiveRejectedInvoiceRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/invoices/{$this->data->id}/archive-rejected";
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
