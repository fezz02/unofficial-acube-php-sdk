<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\User\Requests;

use Fezz\Acube\Sdk\Italy\User\Dto\UpdateAcceptOnlyVerifiedInvoicesRequestDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Request for updating verified invoices status.
 *
 * This request sends a PUT request to update verified supplier invoices status.
 *
 * Endpoint: PUT /users/{id}/accept-only-verified-invoices
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/users/
 */
final class UpdateAcceptOnlyVerifiedInvoicesRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    /**
     * Create a new update accept only verified invoices request.
     *
     * @param  UpdateAcceptOnlyVerifiedInvoicesRequestDto  $data  The request data including ID and user data
     */
    public function __construct(
        public readonly UpdateAcceptOnlyVerifiedInvoicesRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/users/{$this->data->id}/accept-only-verified-invoices";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return array<string, mixed> The response data
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
     * @return array<string, mixed> The request body containing the user data
     */
    protected function defaultBody(): array
    {
        return $this->data->user;
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
