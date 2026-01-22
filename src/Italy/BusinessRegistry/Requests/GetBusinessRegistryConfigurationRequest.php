<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests;

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\BusinessRegistryConfigurationDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for retrieving a single Business Registry Configuration by fiscal identifier.
 *
 * This request sends a GET request to retrieve a specific business registry configuration by its fiscal identifier.
 *
 * Endpoint: GET /business-registry-configurations/{id}
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry-configuration/
 */
final class GetBusinessRegistryConfigurationRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get business registry configuration request.
     *
     * @param  string  $id  The fiscal identifier of the Business Registry Configuration
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
        return "/business-registry-configurations/{$this->id}";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return BusinessRegistryConfigurationDto The response DTO containing the business registry configuration data
     */
    public function createDtoFromResponse(Response $response): BusinessRegistryConfigurationDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return BusinessRegistryConfigurationDto::from($json);
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
