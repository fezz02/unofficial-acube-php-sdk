<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\Authentication;

use Fezz\Acube\Sdk\BaseResource;
use Fezz\Acube\Sdk\Common\Authentication\Requests\LoginRequest;
use Saloon\Http\Response;

/**
 * Authentication API resource for the A-Cube Common API.
 *
 * Provides methods for authenticating with the A-Cube API using email and password,
 * and for retrieving information from authenticated tokens.
 *
 * @see https://docs.acubeapi.com/documentation/common/authentication/
 */
final class Api extends BaseResource
{
    /**
     * Login with email and password.
     *
     * Sends a POST request to the `/login` endpoint and returns the HTTP response.
     * Use `$response->dto()` to get the `LoginResponseDto` containing the JWT token.
     * This method does not automatically authenticate the connector - use `authenticate()`
     * for a complete authentication flow.
     *
     * @param  string  $email  The user's email address
     * @param  string  $password  The user's password
     * @return Response The HTTP response (call `$response->dto()` to get `LoginResponseDto`)
     *
     * @see https://docs.acubeapi.com/documentation/common/authentication/
     */
    public function login(string $email, string $password): Response
    {
        return $this->connector->send(new LoginRequest($email, $password));
    }
}
