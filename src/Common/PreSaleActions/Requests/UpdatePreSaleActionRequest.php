<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\PreSaleActions\Requests;

use Fezz\Acube\Sdk\Common\PreSaleActions\Dto\PreSaleActionDto;
use Fezz\Acube\Sdk\Common\PreSaleActions\Dto\UpdatePreSaleActionRequestDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Request for updating a pre-sale action.
 *
 * This request sends a PUT request to update an existing pre-sale action.
 *
 * Endpoint: PUT /pre-sale-actions/{uuid}
 * Base URL: https://common.api.acubeapi.com (production) or https://common-sandbox.api.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/common/pre-sale-actions/
 */
final class UpdatePreSaleActionRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    /**
     * Create a new update pre-sale action request.
     *
     * @param  string  $uuid  The pre-sale action UUID
     * @param  UpdatePreSaleActionRequestDto  $payload  The update payload (excluding UUID)
     */
    public function __construct(
        public readonly string $uuid,
        public readonly UpdatePreSaleActionRequestDto $payload,
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/pre-sale-actions/{$this->uuid}";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return PreSaleActionDto The response DTO containing the updated pre-sale action data
     */
    public function createDtoFromResponse(Response $response): PreSaleActionDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return PreSaleActionDto::from($json);
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
