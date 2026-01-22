<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\InvoiceExtract\Requests;

use Fezz\Acube\Sdk\Italy\InvoiceExtract\Dto\GetInvoiceExtractJobRequestDto;
use Fezz\Acube\Sdk\Italy\InvoiceExtract\Dto\InvoiceExtractJobDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for retrieving an invoice extract job by UUID.
 *
 * This request sends a GET request to retrieve the status of an invoice extraction job.
 *
 * Endpoint: GET /invoice-extract/{uuid}
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoice-extract/
 */
final class GetInvoiceExtractJobRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get invoice extract job request.
     *
     * @param  GetInvoiceExtractJobRequestDto  $data  The request data including UUID
     */
    public function __construct(
        public readonly GetInvoiceExtractJobRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/invoice-extract/{$this->data->uuid}";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return InvoiceExtractJobDto The response DTO containing the job information
     */
    public function createDtoFromResponse(Response $response): InvoiceExtractJobDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return InvoiceExtractJobDto::from($json);
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
