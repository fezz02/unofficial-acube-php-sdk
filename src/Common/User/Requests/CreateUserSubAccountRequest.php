<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\User\Requests;

use Fezz\Acube\Sdk\Common\User\Dto\CreateUserSubAccountRequestDto;
use Fezz\Acube\Sdk\Common\User\Dto\GetUserSubAccountsResponseDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Request for creating a new user sub-account.
 *
 * This request sends a POST request to create a new sub-account for the authenticated user.
 *
 * Endpoint: POST /users/me/accounts
 * Base URL: https://common.api.acubeapi.com (production) or https://common-sandbox.api.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/common/user/#create-user-sub-account
 */
final class CreateUserSubAccountRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * Create a new create sub-account request.
     *
     * @param  CreateUserSubAccountRequestDto  $data  The sub-account data (email, password, fiscal_id, etc.)
     */
    public function __construct(
        public readonly CreateUserSubAccountRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return '/users/me/accounts';
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return GetUserSubAccountsResponseDto The response DTO containing the created sub-account
     */
    public function createDtoFromResponse(Response $response): GetUserSubAccountsResponseDto
    {
        /** @var array<int, array<string, mixed>> $json */
        $json = $response->json();

        return GetUserSubAccountsResponseDto::from($json);
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
     * @return array<string, mixed> The request body containing the sub-account data
     */
    protected function defaultBody(): array
    {
        return $this->data->all();
    }
}
