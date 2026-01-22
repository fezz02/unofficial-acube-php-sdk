<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\User\Requests;

use Fezz\Acube\Sdk\Common\User\Dto\UpdateUserProfileRequestDto;
use Fezz\Acube\Sdk\Common\User\Dto\UserProfileDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Request for updating a user profile.
 *
 * This request sends a PUT request to update a user profile with invoicing information.
 * The ID can be "me" to update the current authenticated user's profile.
 *
 * Endpoint: PUT /users/{id}
 * Base URL: https://common.api.acubeapi.com (production) or https://common-sandbox.api.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/common/user/
 */
final class UpdateUserProfileRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    /**
     * Create a new update user profile request.
     *
     * @param  string  $id  The user ID (can be "me" for the current user)
     * @param  UpdateUserProfileRequestDto  $payload  The update payload (excluding ID)
     */
    public function __construct(
        public readonly string $id,
        public readonly UpdateUserProfileRequestDto $payload,
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
     * @return UserProfileDto The response DTO containing the updated user profile with invoicing data
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
