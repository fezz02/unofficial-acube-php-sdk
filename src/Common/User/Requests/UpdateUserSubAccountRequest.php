<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\User\Requests;

use Fezz\Acube\Sdk\Common\User\Dto\UpdateUserSubAccountRequestDto;
use Fezz\Acube\Sdk\Common\User\Dto\UserSubAccountDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Request for updating a user sub-account.
 *
 * This request sends a PUT request to update an existing sub-account.
 *
 * Endpoint: PUT /users/me/accounts/{id}
 * Base URL: https://common.api.acubeapi.com (production) or https://common-sandbox.api.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/common/user/
 */
final class UpdateUserSubAccountRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    /**
     * Create a new update sub-account request.
     *
     * @param  string  $id  The sub-account ID
     * @param  UpdateUserSubAccountRequestDto  $payload  The update payload (excluding ID)
     */
    public function __construct(
        public readonly string $id,
        public readonly UpdateUserSubAccountRequestDto $payload,
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/users/me/accounts/{$this->id}";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return UserSubAccountDto The response DTO containing the updated sub-account data
     */
    public function createDtoFromResponse(Response $response): UserSubAccountDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return UserSubAccountDto::from($json);
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
     * @return array<string, mixed> The request body containing the update payload
     */
    protected function defaultBody(): array
    {
        return $this->payload->all();
    }
}
