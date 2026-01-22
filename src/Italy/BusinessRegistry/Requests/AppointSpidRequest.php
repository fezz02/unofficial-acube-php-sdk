<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests;

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\AppointSpidRequestDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Request for appointing a 3rd party person to use receipt services via SPID.
 *
 * This request sends a PUT request to appoint a 3rd party person to use the receipt services
 * on the Agenzia delle Entrate portal with SPID credentials.
 *
 * Endpoint: PUT /business-registry-configurations/{id}/appoint/spid
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry-configuration/
 */
final class AppointSpidRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    /**
     * Create a new appoint SPID request.
     *
     * @param  AppointSpidRequestDto  $data  The request data including fiscal identifier and appointing person data
     */
    public function __construct(
        public readonly AppointSpidRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/business-registry-configurations/{$this->data->id}/appoint/spid";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return array<string, mixed> The response containing the URL for the appointing process
     */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return $json;
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
            'appointing_person_data' => [
                'fiscal_code' => $this->data->appointing_person_data_fiscal_code,
                'name' => $this->data->appointing_person_data_name,
                'surname' => $this->data->appointing_person_data_surname,
                'residence' => $this->data->appointing_person_data_residence,
                'otp_cell_phone' => $this->data->appointing_person_data_otp_cell_phone,
                'email' => $this->data->appointing_person_data_email,
            ],
            'return_url' => $this->data->return_url,
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
