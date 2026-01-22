<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\CassettoFiscale\Requests;

use Fezz\Acube\Sdk\Italy\CassettoFiscale\Dto\ScheduledInvoiceDownloadDto;
use Fezz\Acube\Sdk\Italy\CassettoFiscale\Dto\ScheduleInvoiceDownloadRequestDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Request for scheduling invoice downloads.
 *
 * This request sends a POST request to schedule daily invoice downloads
 * from the "Cassetto Fiscale" at 03:00 UTC.
 *
 * Endpoint: POST /schedule/invoice-download/{fiscal_id}
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/cassetto-fiscale/
 */
final class ScheduleInvoiceDownloadRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * Create a new schedule invoice download request.
     *
     * @param  string  $fiscalId  The fiscal ID
     * @param  ScheduleInvoiceDownloadRequestDto  $payload  The schedule configuration (excluding fiscal_id)
     */
    public function __construct(
        public readonly string $fiscalId,
        public readonly ScheduleInvoiceDownloadRequestDto $payload,
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/schedule/invoice-download/{$this->fiscalId}";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return ScheduledInvoiceDownloadDto The response DTO containing the schedule information
     */
    public function createDtoFromResponse(Response $response): ScheduledInvoiceDownloadDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return ScheduledInvoiceDownloadDto::from($json);
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
     * @return array<string, mixed> The request body containing the schedule configuration
     */
    protected function defaultBody(): array
    {
        return $this->payload->all();
    }
}
