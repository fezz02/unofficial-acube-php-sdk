<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\ApiConfiguration\Requests;

use Fezz\Acube\Sdk\Italy\ApiConfiguration\Dto\ApiConfigurationDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for retrieving a single API configuration by UUID.
 *
 * Endpoint: GET /api-configurations/{id}
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/
 */
final class GetApiConfigurationRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get API configuration request.
     *
     * @param  string  $id  The API configuration UUID
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
        return "/api-configurations/{$this->id}";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return ApiConfigurationDto The response DTO containing the API configuration data
     */
    public function createDtoFromResponse(Response $response): ApiConfigurationDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return ApiConfigurationDto::from($json);
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
