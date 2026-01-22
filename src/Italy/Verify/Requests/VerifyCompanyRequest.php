<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Verify\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for verifying a company.
 *
 * This request sends a GET request to retrieve information about a company.
 *
 * Endpoint: GET /verify/company/{id}
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/verify/
 */
final class VerifyCompanyRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new verify company request.
     *
     * @param  string  $id  VAT number WITHOUT the country prefix, or fiscal id
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
        return "/verify/company/{$this->id}";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return array<string, mixed> The response data (company information)
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
