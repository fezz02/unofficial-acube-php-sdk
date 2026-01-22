<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests;

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\ReportingDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for getting reporting parameters.
 *
 * This request sends a GET request to retrieve reporting parameters for a business registry configuration.
 *
 * Endpoint: GET /business-registry-configurations/{id}/reporting
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry-configuration/
 */
final class GetReportingRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get reporting request.
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
        return "/business-registry-configurations/{$this->id}/reporting";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return ReportingDto The response DTO containing the reporting parameters
     */
    public function createDtoFromResponse(Response $response): ReportingDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return ReportingDto::from($json);
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
