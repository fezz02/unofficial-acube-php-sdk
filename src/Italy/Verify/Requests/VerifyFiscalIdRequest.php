<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Verify\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for verifying a fiscal ID.
 *
 * This request sends a GET request to verify if a fiscal ID is valid.
 *
 * Endpoint: GET /verify/fiscal-id/{id}
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/verify/
 */
final class VerifyFiscalIdRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new verify fiscal ID request.
     *
     * @param  string  $id  Fiscal id
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
        return "/verify/fiscal-id/{$this->id}";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return array<string, mixed> The response data (fiscal ID validity)
     */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return $json;
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
