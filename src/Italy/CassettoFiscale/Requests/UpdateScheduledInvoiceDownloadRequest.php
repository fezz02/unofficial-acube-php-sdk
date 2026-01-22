<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\CassettoFiscale\Requests;

use Fezz\Acube\Sdk\Italy\CassettoFiscale\Dto\ScheduledInvoiceDownloadDto;
use Fezz\Acube\Sdk\Italy\CassettoFiscale\Dto\UpdateScheduledInvoiceDownloadRequestDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Request for updating scheduled invoice download auto-renewal.
 *
 * This request sends a PUT request to update the auto-renewal setting
 * for a scheduled invoice download.
 *
 * Endpoint: PUT /schedule/invoice-download/{fiscal_id}
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/cassetto-fiscale/
 */
final class UpdateScheduledInvoiceDownloadRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    /**
     * Create a new update scheduled invoice download request.
     *
     * @param  string  $fiscalId  The fiscal ID
     * @param  UpdateScheduledInvoiceDownloadRequestDto  $payload  The update payload (excluding fiscal_id)
     */
    public function __construct(
        public readonly string $fiscalId,
        public readonly UpdateScheduledInvoiceDownloadRequestDto $payload,
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
     * @return ScheduledInvoiceDownloadDto The response DTO containing the updated schedule information
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
     * @return array<string, mixed> The request body containing the auto-renewal setting
     */
    protected function defaultBody(): array
    {
        return $this->payload->all();
    }
}
