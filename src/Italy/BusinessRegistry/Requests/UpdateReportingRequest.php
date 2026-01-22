<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests;

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\ReportingDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\UpdateReportingRequestDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Request for updating reporting parameters.
 *
 * This request sends a PUT request to replace reporting parameters for a business registry configuration.
 *
 * Endpoint: PUT /business-registry-configurations/{id}/reporting
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry-configuration/
 */
final class UpdateReportingRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    /**
     * Create a new update reporting request.
     *
     * @param  string  $id  The fiscal identifier of the Business Registry Configuration
     * @param  UpdateReportingRequestDto  $bodyData  The body data including reporting parameters
     */
    public function __construct(
        public readonly string $id,
        public readonly UpdateReportingRequestDto $bodyData
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/business-registry-configurations/{$this->id}/reporting";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return ReportingDto The response DTO containing the updated reporting parameters
     */
    public function createDtoFromResponse(Response $response): ReportingDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return ReportingDto::from($json);
    }

    /**
     * Get the default body for the request.
     *
     * @return array<string, mixed> The request body containing the reporting parameters
     */
    protected function defaultBody(): array
    {
        return [
            'rejected_invoices_alert_schedule' => $this->bodyData->rejected_invoices_alert_schedule,
        ];
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
}
