<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests;

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\AppointStatusDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for getting the status of an appointing request.
 *
 * This request sends a GET request to retrieve the status of an appointing request
 * for a business registry configuration.
 *
 * Endpoint: GET /business-registry-configurations/{id}/appoint/status
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry-configuration/
 */
final class GetAppointStatusRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get appoint status request.
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
        return "/business-registry-configurations/{$this->id}/appoint/status";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return AppointStatusDto The response DTO containing the appoint status
     */
    public function createDtoFromResponse(Response $response): AppointStatusDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return AppointStatusDto::from($json);
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
