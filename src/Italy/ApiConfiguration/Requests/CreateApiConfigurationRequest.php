<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\ApiConfiguration\Requests;

use Fezz\Acube\Sdk\Italy\ApiConfiguration\Dto\ApiConfigurationDto;
use Fezz\Acube\Sdk\Italy\ApiConfiguration\Dto\CreateApiConfigurationRequestDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Request for creating an API configuration.
 *
 * Endpoint: POST /api-configurations
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/
 */
final class CreateApiConfigurationRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * Create a new create API configuration request.
     *
     * @param  CreateApiConfigurationRequestDto  $data  The request data including API configuration data
     */
    public function __construct(
        public readonly CreateApiConfigurationRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return '/api-configurations';
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return ApiConfigurationDto The response DTO containing the created API configuration
     */
    public function createDtoFromResponse(Response $response): ApiConfigurationDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return ApiConfigurationDto::from($json);
    }

    /**
     * Get the default body for the request.
     *
     * @return array<string, mixed> The request body containing the API configuration data
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
