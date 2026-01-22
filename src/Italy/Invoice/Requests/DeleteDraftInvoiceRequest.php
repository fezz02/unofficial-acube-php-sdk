<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Requests;

use Fezz\Acube\Sdk\Italy\Invoice\Dto\DeleteDraftInvoiceRequestDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Request for deleting a draft invoice.
 *
 * This request sends a DELETE request to delete a draft invoice.
 * All the contents will be completely removed from the platform.
 *
 * Endpoint: DELETE /invoices/draft/{id}
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final class DeleteDraftInvoiceRequest extends Request
{
    protected Method $method = Method::DELETE;

    /**
     * Create a new delete draft invoice request.
     *
     * @param  DeleteDraftInvoiceRequestDto  $data  The request data including ID
     */
    public function __construct(
        public readonly DeleteDraftInvoiceRequestDto $data
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
