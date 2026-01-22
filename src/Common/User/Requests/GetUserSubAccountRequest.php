<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\User\Requests;

use Fezz\Acube\Sdk\Common\User\Dto\UserSubAccountDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for retrieving a single user sub-account by ID.
 *
 * This request sends a GET request to retrieve a specific sub-account
 * by its ID.
 *
 * Endpoint: GET /users/me/accounts/{id}
 * Base URL: https://common.api.acubeapi.com (production) or https://common-sandbox.api.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/common/user/
 */
final class GetUserSubAccountRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get sub-account request.
     *
     * @param  string  $id  The sub-account ID
     */
    public function __construct(
        public readonly string $id
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
     * @return UserSubAccountDto The response DTO containing the sub-account data
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
        ];
    }
}
