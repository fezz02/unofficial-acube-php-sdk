<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Requests;

use Fezz\Acube\Sdk\Italy\Invoice\Dto\GetInvoicesRequestDto;
use Fezz\Acube\Sdk\Italy\Invoice\Dto\GetInvoicesResponseDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for retrieving invoices.
 *
 * This request sends a GET request to retrieve a collection of invoices
 * with optional query parameters for filtering and pagination.
 *
 * Endpoint: GET /invoices
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final class GetInvoicesRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get invoices request.
     *
     * @param  GetInvoicesRequestDto  $data  The request data including optional query parameters
     */
    public function __construct(
        public readonly GetInvoicesRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return '/invoices';
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return GetInvoicesResponseDto The response DTO containing the list of invoices
     */
    public function createDtoFromResponse(Response $response): GetInvoicesResponseDto
    {
        /** @var array<int, array<string, mixed>> $json */
        $json = $response->json();

        return GetInvoicesResponseDto::from($json);
    }

    /**
     * Get the query parameters for the request.
     *
     * @return array<string, mixed> The query parameters
     */
    protected function defaultQuery(): array
    {
        return $this->data->query;
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
