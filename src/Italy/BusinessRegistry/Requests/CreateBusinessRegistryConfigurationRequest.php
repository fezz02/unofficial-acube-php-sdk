<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests;

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\BusinessRegistryConfigurationDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\CreateBusinessRegistryConfigurationRequestDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Request for creating a Business Registry Configuration.
 *
 * This request sends a POST request to create a new business registry configuration.
 *
 * Endpoint: POST /business-registry-configurations
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry-configuration/
 */
final class CreateBusinessRegistryConfigurationRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * Create a new create business registry configuration request.
     *
     * @param  CreateBusinessRegistryConfigurationRequestDto  $data  The request data including business registry configuration data
     */
    public function __construct(
        public readonly CreateBusinessRegistryConfigurationRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return '/business-registry-configurations';
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return BusinessRegistryConfigurationDto The response DTO containing the created business registry configuration
     */
    public function createDtoFromResponse(Response $response): BusinessRegistryConfigurationDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return BusinessRegistryConfigurationDto::from($json);
    }

    /**
     * Get the default body for the request.
     *
     * @return array<string, mixed> The request body containing the business registry configuration data
     */
    protected function defaultBody(): array
    {
        $body = $this->data->all();

        // Filter out null values to avoid sending them to the API
        // Empty arrays are kept (e.g., api_configurations: [])
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
