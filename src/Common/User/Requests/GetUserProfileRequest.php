<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\User\Requests;

use Fezz\Acube\Sdk\Common\User\Dto\UserProfileDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for retrieving a user profile.
 *
 * This request sends a GET request to retrieve a user profile by ID.
 * The ID can be "me" to get the current authenticated user's profile.
 *
 * Endpoint: GET /users/{id}
 * Base URL: https://common.api.acubeapi.com (production) or https://common-sandbox.api.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/common/user/
 */
final class GetUserProfileRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get user profile request.
     *
     * @param  string  $id  The user ID (can be "me" for the current user, defaults to "me")
     */
    public function __construct(
        public readonly string $id = 'me'
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/users/{$this->id}";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return UserProfileDto The response DTO containing the user profile with invoicing data
     */
    public function createDtoFromResponse(Response $response): UserProfileDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return UserProfileDto::from($json);
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
