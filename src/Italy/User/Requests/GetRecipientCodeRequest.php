<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\User\Requests;

use Fezz\Acube\Sdk\Italy\User\Dto\GetRecipientCodeRequestDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for getting recipient code.
 *
 * This request sends a GET request to retrieve the 7-character recipient code.
 *
 * Endpoint: GET /users/{id}/recipient-code
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/users/
 */
final class GetRecipientCodeRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get recipient code request.
     *
     * @param  GetRecipientCodeRequestDto  $dto  The request data including user ID
     */
    public function __construct(
        public readonly GetRecipientCodeRequestDto $dto,
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/users/{$this->dto->id}/recipient-code";
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
