<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests;

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\BusinessRegistryDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\UpdateBusinessRegistryRequestDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Request for updating a Business Registry entry.
 *
 * This request sends a PUT request to replace an existing business registry entry.
 *
 * Endpoint: PUT /business-registries/{id}
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry/
 */
final class UpdateBusinessRegistryRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    /**
     * Create a new update business registry request.
     *
     * @param  string  $id  The ID of the business registry entry
     * @param  UpdateBusinessRegistryRequestDto  $bodyData  The body data including business registry data
     */
    public function __construct(
        public readonly string $id,
        public readonly UpdateBusinessRegistryRequestDto $bodyData
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
     * @return BusinessRegistryDto The response DTO containing the updated business registry
     */
    public function createDtoFromResponse(Response $response): BusinessRegistryDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return BusinessRegistryDto::from($json);
    }

    /**
     * Get the default body for the request.
     *
     * @return array<string, mixed> The request body containing the business registry data
     */
    protected function defaultBody(): array
    {
        $body = $this->bodyData->all();

        // Filter out null values to avoid sending them to the API
        return array_filter(
            $body,
            static fn (mixed $value): bool => $value !== null
        );
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
            'Content-Type' => 'application/json',
        ];
    }
}
