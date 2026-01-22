<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests;

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\BusinessRegistryDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\CreateBusinessRegistryRequestDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Request for creating a Business Registry entry.
 *
 * This request sends a POST request to create a new business registry entry.
 *
 * Endpoint: POST /business-registries
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry/
 */
final class CreateBusinessRegistryRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * Create a new create business registry request.
     *
     * @param  CreateBusinessRegistryRequestDto  $data  The request data including business registry data
     */
    public function __construct(
        public readonly CreateBusinessRegistryRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return '/business-registries';
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return BusinessRegistryDto The response DTO containing the created business registry
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
        $body = $this->data->all();

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
