<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Receipt\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Request for voiding a receipt.
 *
 * This request sends a DELETE request to void an electronic receipt.
 * Only receipts in `submitted` and `ready` status can be voided.
 *
 * Endpoint: DELETE /receipts/{id}
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/receipts/
 */
final class DeleteReceiptRequest extends Request
{
    protected Method $method = Method::DELETE;

    /**
     * Create a new delete receipt request.
     *
     * @param  string  $id  The ID of the receipt to void
     */
    public function __construct(
        public readonly string $id
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/receipts/{$this->id}";
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
