<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests;

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\AddSubAccountRequestDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\SubAccountDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Request for adding a sub account.
 *
 * This request sends a POST request to add a new sub account to a business registry configuration.
 *
 * Endpoint: POST /business-registry-configurations/{id}/sub-accounts
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry-configuration/
 */
final class AddSubAccountRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * Create a new add sub account request.
     *
     * @param  AddSubAccountRequestDto  $data  The request data including fiscal identifier and sub account data
     */
    public function __construct(
        public readonly AddSubAccountRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/business-registry-configurations/{$this->data->id}/sub-accounts";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return SubAccountDto The response DTO containing the created sub account
     */
    public function createDtoFromResponse(Response $response): SubAccountDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return SubAccountDto::from($json);
    }

    /**
     * Get the default body for the request.
     *
     * @return array<string, mixed> The request body containing the sub account data
     */
    protected function defaultBody(): array
    {
        $body = [
            'email' => $this->data->email,
        ];

        if ($this->data->password !== null) {
            $body['password'] = $this->data->password;
        }

        return $body;
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
