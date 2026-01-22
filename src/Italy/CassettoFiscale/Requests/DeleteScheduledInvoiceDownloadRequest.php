<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\CassettoFiscale\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Request for deleting a scheduled invoice download.
 *
 * This request sends a DELETE request to remove a scheduled invoice download.
 *
 * Endpoint: DELETE /schedule/invoice-download/{fiscal_id}
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/cassetto-fiscale/
 */
final class DeleteScheduledInvoiceDownloadRequest extends Request
{
    protected Method $method = Method::DELETE;

    /**
     * Create a new delete scheduled invoice download request.
     *
     * @param  string  $fiscalId  The fiscal ID
     */
    public function __construct(
        public readonly string $fiscalId
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/schedule/invoice-download/{$this->fiscalId}";
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
