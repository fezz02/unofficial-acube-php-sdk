<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\InvoiceTransfer\Requests;

use Fezz\Acube\Sdk\Italy\InvoiceTransfer\Dto\GetInvoiceTransferRequestDto;
use Fezz\Acube\Sdk\Italy\InvoiceTransfer\Dto\InvoiceTransferDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for retrieving a single invoice transfer by ID.
 *
 * This request sends a GET request to retrieve a specific invoice transfer by its ID.
 *
 * Endpoint: GET /invoice-transfers/{id}
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoice-transfers/
 */
final class GetInvoiceTransferRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get invoice transfer request.
     *
     * @param  GetInvoiceTransferRequestDto  $data  The request data including ID
     */
    public function __construct(
        public readonly GetInvoiceTransferRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/invoice-transfers/{$this->data->id}";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return InvoiceTransferDto The response DTO containing the invoice transfer data
     */
    public function createDtoFromResponse(Response $response): InvoiceTransferDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return InvoiceTransferDto::from($json);
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
