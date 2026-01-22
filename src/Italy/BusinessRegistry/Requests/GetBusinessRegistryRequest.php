<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests;

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\BusinessRegistryDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for retrieving a single Business Registry entry by ID.
 *
 * This request sends a GET request to retrieve a specific business registry entry by its ID.
 *
 * Endpoint: GET /business-registries/{id}
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry/
 */
final class GetBusinessRegistryRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get business registry request.
     *
     * @param  string  $id  The ID of the business registry entry
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
        return "/business-registries/{$this->id}";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return BusinessRegistryDto The response DTO containing the business registry data
     */
    public function createDtoFromResponse(Response $response): BusinessRegistryDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return BusinessRegistryDto::from($json);
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
