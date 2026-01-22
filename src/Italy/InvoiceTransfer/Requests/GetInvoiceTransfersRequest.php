<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\InvoiceTransfer\Requests;

use Fezz\Acube\Sdk\Italy\InvoiceTransfer\Dto\GetInvoiceTransfersRequestDto;
use Fezz\Acube\Sdk\Italy\InvoiceTransfer\Dto\InvoiceTransferDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for listing invoice transfers.
 *
 * This request sends a GET request to retrieve a collection of invoice transfers
 * with optional query parameters for filtering.
 *
 * Endpoint: GET /invoice-transfers
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoice-transfers/
 */
final class GetInvoiceTransfersRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get invoice transfers request.
     *
     * @param  GetInvoiceTransfersRequestDto  $data  The request data including optional query parameters
     */
    public function __construct(
        public readonly GetInvoiceTransfersRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return '/invoice-transfers';
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return array<int, InvoiceTransferDto> The response DTO containing the list of invoice transfers
     */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<int, array<string, mixed>> $json */
        $json = $response->json();

        return array_map(
            InvoiceTransferDto::from(...),
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
