<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Receipt\Requests;

use Fezz\Acube\Sdk\Italy\Receipt\Dto\GetReceiptsRequestDto;
use Fezz\Acube\Sdk\Italy\Receipt\Dto\ReceiptDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for listing receipts.
 *
 * This request sends a GET request to retrieve a collection of electronic receipts
 * with optional query parameters for filtering.
 *
 * Endpoint: GET /receipts
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/receipts/
 */
final class GetReceiptsRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get receipts request.
     *
     * @param  GetReceiptsRequestDto  $data  The request data including optional query parameters
     */
    public function __construct(
        public readonly GetReceiptsRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return '/receipts';
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return array<int, ReceiptDto> The response DTO containing the list of receipts
     */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<int, array<string, mixed>> $json */
        $json = $response->json();

        return array_map(
            ReceiptDto::from(...),
            $json
        );
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
