<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\Consumptions\Requests;

use Fezz\Acube\Sdk\Common\Consumptions\Dto\ConsumptionDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for retrieving a single consumption by UUID.
 *
 * This request sends a GET request to retrieve a specific consumption by its UUID.
 *
 * Endpoint: GET /consumptions/{uuid}
 * Base URL: https://common.api.acubeapi.com (production) or https://common-sandbox.api.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/common/consumptions/
 */
final class GetConsumptionRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get consumption request.
     *
     * @param  string  $uuid  The UUID of the consumption to retrieve
     */
    public function __construct(
        public readonly string $uuid
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/consumptions/{$this->uuid}";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return ConsumptionDto The response DTO containing the consumption data
     */
    public function createDtoFromResponse(Response $response): ConsumptionDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return ConsumptionDto::from($json);
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
