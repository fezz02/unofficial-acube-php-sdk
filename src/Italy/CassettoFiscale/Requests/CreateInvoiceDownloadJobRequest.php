<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\CassettoFiscale\Requests;

use Fezz\Acube\Sdk\Italy\CassettoFiscale\Dto\CreateInvoiceDownloadJobRequestDto;
use Fezz\Acube\Sdk\Italy\CassettoFiscale\Dto\CreateInvoiceDownloadJobResponseDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Request for creating a one-shot invoice download job.
 *
 * This request sends a POST request to create a one-time invoice download job
 * for a specific date range.
 *
 * Endpoint: POST /jobs/invoice-download
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/cassetto-fiscale/
 */
final class CreateInvoiceDownloadJobRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * Create a new create invoice download job request.
     *
     * @param  CreateInvoiceDownloadJobRequestDto  $data  The job data
     */
    public function __construct(
        public readonly CreateInvoiceDownloadJobRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return '/jobs/invoice-download';
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return CreateInvoiceDownloadJobResponseDto The response DTO containing the job UUID
     */
    public function createDtoFromResponse(Response $response): CreateInvoiceDownloadJobResponseDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return CreateInvoiceDownloadJobResponseDto::from($json);
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
            'Content-Type' => 'application/json',
        ];
    }

    /**
     * Get the default body for the request.
     *
     * @return array<string, mixed> The request body containing the job data
     */
    protected function defaultBody(): array
    {
        return $this->data->all();
    }
}
