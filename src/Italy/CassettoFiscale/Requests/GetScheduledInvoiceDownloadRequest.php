<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\CassettoFiscale\Requests;

use Fezz\Acube\Sdk\Italy\CassettoFiscale\Dto\ScheduledInvoiceDownloadDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for retrieving scheduled invoice download information.
 *
 * This request sends a GET request to retrieve the current schedule configuration.
 *
 * Endpoint: GET /schedule/invoice-download/{fiscal_id}
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/cassetto-fiscale/
 */
final class GetScheduledInvoiceDownloadRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get scheduled invoice download request.
     *
     * @param  string  $fiscalId  The fiscal ID
     */
    public function __construct(
        public readonly string $fiscalId
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
        ];
    }
}
