<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\InvoiceExtract\Requests;

use Fezz\Acube\Sdk\Italy\InvoiceExtract\Dto\GetInvoiceExtractRawRequestDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for getting raw invoice extract data.
 *
 * This request sends a GET request to retrieve the raw extracted information
 * from a PDF invoice in JSON format.
 *
 * Endpoint: GET /invoice-extract/{id}/raw
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoice-extract/
 */
final class GetInvoiceExtractRawRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get invoice extract raw request.
     *
     * @param  GetInvoiceExtractRawRequestDto  $data  The request data including UUID
     */
    public function __construct(
        public readonly GetInvoiceExtractRawRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/invoice-extract/{$this->data->uuid}/raw";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return array<string, mixed> The response data (raw extracted information)
     */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return $json;
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
