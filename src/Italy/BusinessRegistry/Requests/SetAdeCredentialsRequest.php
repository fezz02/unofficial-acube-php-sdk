<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests;

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\SetAdeCredentialsRequestDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Request for setting Agenzia delle Entrate credentials.
 *
 * This request sends a PUT request to update the credentials to access the Agenzia delle Entrate portal (FiscOnline / Entratel).
 *
 * Endpoint: PUT /business-registry-configurations/{id}/credentials/fisconline
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry-configuration/
 */
final class SetAdeCredentialsRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    /**
     * Create a new set ADE credentials request.
     *
     * @param  SetAdeCredentialsRequestDto  $data  The request data including fiscal identifier and credentials
     */
    public function __construct(
        public readonly SetAdeCredentialsRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/business-registry-configurations/{$this->data->id}/credentials/fisconline";
    }

    /**
     * Get the default body for the request.
     *
     * @return array<string, mixed> The request body containing the credentials
     */
    protected function defaultBody(): array
    {
        return [
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
