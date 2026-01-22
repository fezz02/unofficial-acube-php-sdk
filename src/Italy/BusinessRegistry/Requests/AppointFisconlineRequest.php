<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests;

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\AppointFisconlineRequestDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Request for appointing A-Cube to use receipt services via FiscOnline/Entratel.
 *
 * This request sends a PUT request to appoint A-Cube to use the receipt services
 * on the Agenzia delle Entrate portal using FiscOnline / Entratel credentials.
 *
 * Endpoint: PUT /business-registry-configurations/{id}/appoint/fisconline
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry-configuration/
 */
final class AppointFisconlineRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    /**
     * Create a new appoint FiscOnline request.
     *
     * @param  AppointFisconlineRequestDto  $data  The request data including fiscal identifier and credentials
     */
    public function __construct(
        public readonly AppointFisconlineRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/business-registry-configurations/{$this->data->id}/appoint/fisconline";
    }

    /**
     * Get the default body for the request.
     *
     * @return array<string, mixed> The request body containing the appointment data
     */
    protected function defaultBody(): array
    {
        return [
            'appointee_fiscal_id' => $this->data->appointee_fiscal_id,
            'codice_fiscale' => $this->data->codice_fiscale,
            'password' => $this->data->password,
            'pin' => $this->data->pin,
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
