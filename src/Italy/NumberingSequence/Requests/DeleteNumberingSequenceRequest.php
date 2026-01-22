<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\NumberingSequence\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Request for deleting a numbering sequence.
 *
 * This request sends a DELETE request to delete a numbering sequence.
 *
 * Endpoint: DELETE /numbering-sequences/{id}
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/numbering-sequences/
 */
final class DeleteNumberingSequenceRequest extends Request
{
    protected Method $method = Method::DELETE;

    /**
     * Create a new delete numbering sequence request.
     *
     * @param  string  $id  The ID of the numbering sequence to delete
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
        return "/numbering-sequences/{$this->id}";
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
