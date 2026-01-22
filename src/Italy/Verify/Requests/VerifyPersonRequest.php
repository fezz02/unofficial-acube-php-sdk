<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Verify\Requests;

use Fezz\Acube\Sdk\Italy\Verify\Dto\VerifyPersonRequestDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Request for verifying a person.
 *
 * This request sends a POST request to create a verification request for a person.
 * The response will be sent to your configured endpoints.
 *
 * Endpoint: POST /verify/person
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/verify/
 */
final class VerifyPersonRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * Create a new verify person request.
     *
     * @param  VerifyPersonRequestDto  $data  The request data including person data
     */
    public function __construct(
        public readonly VerifyPersonRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return '/verify/person';
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
     * Get the default body for the request.
     *
     * @return array<string, mixed> The request body containing the person data
     */
    protected function defaultBody(): array
    {
        return $this->data->person;
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
}
