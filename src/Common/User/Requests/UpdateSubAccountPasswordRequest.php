<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\User\Requests;

use Fezz\Acube\Sdk\Common\User\Dto\UpdateSubAccountPasswordRequestDto;
use Fezz\Acube\Sdk\Common\User\Dto\UserProfileDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Request for updating a sub-account password.
 *
 * This request sends a PUT request to update the password of a sub-account.
 *
 * Endpoint: PUT /users/me/accounts/{id}/change-password
 * Base URL: https://common.api.acubeapi.com (production) or https://common-sandbox.api.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/common/user/
 */
final class UpdateSubAccountPasswordRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    /**
     * Create a new update sub-account password request.
     *
     * @param  UpdateSubAccountPasswordRequestDto  $data  The password data including sub-account ID
     */
    public function __construct(
        public readonly UpdateSubAccountPasswordRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/users/me/accounts/{$this->data->id}/change-password";
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
            'Content-Type' => 'application/json',
        ];
    }

    /**
     * Get the default body for the request.
     *
     * @return array<string, string> The request body containing the password
     */
    protected function defaultBody(): array
    {
        return ['password' => $this->data->password];
    }
}
