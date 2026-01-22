<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\PreSales\Requests;

use Fezz\Acube\Sdk\Common\PreSales\Dto\PreSaleDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for retrieving a single pre-sale by UUID.
 *
 * This request sends a GET request to retrieve a specific pre-sale by its UUID.
 *
 * Endpoint: GET /pre-sales/{uuid}
 * Base URL: https://common.api.acubeapi.com (production) or https://common-sandbox.api.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/common/pre-sales/
 */
final class GetPreSaleRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get pre-sale request.
     *
     * @param  string  $uuid  The pre-sale UUID
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
        return "/pre-sales/{$this->uuid}";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return PreSaleDto The response DTO containing the pre-sale data
     */
    public function createDtoFromResponse(Response $response): PreSaleDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return PreSaleDto::from($json);
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
