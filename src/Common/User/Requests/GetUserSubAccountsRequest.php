<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\User\Requests;

use Fezz\Acube\Sdk\Common\User\Dto\GetUserSubAccountsResponseDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for retrieving user sub-accounts.
 *
 * This request sends a GET request to retrieve a collection of user sub-accounts
 * associated with the authenticated user.
 *
 * Endpoint: GET /users/me/accounts
 * Base URL: https://common.api.acubeapi.com (production) or https://common-sandbox.api.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/common/user/#get-user-sub-accounts
 */
final class GetUserSubAccountsRequest extends Request
{
    protected Method $method = Method::GET;

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
     * @return GetUserSubAccountsResponseDto The response DTO containing the list of sub-accounts
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
        ];
    }
}
