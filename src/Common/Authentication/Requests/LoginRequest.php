<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\Authentication\Requests;

use Fezz\Acube\Sdk\Common\Authentication\Dto\LoginResponseDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Request for authenticating with the A-Cube API.
 *
 * This request sends a POST request to the `/login` endpoint with email and password
 * credentials, and receives a JWT token in response.
 *
 * Endpoint: POST /login
 * Base URL: https://common.api.acubeapi.com (production) or https://common-sandbox.api.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/common/authentication/
 */
final class LoginRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * Create a new login request.
     *
     * @param  string  $email  The user's email address
     * @param  string  $password  The user's password
     */
    public function __construct(
        public string $email,
        public string $password
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return '/login';
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return LoginResponseDto The login response DTO containing the token
     */
    public function createDtoFromResponse(Response $response): LoginResponseDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return LoginResponseDto::from($json);
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
     * @return array<string, string> The request body containing email and password
     */
    protected function defaultBody(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
