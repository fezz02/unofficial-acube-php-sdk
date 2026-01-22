<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\PreSaleActions\Requests;

use Fezz\Acube\Sdk\Common\PreSaleActions\Dto\CreatePreSaleActionRequestDto;
use Fezz\Acube\Sdk\Common\PreSaleActions\Dto\PreSaleActionDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Request for creating a new pre-sale action.
 *
 * This request sends a POST request to create a new pre-sale action.
 *
 * Endpoint: POST /pre-sale-actions
 * Base URL: https://common.api.acubeapi.com (production) or https://common-sandbox.api.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/common/pre-sale-actions/
 */
final class CreatePreSaleActionRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * Create a new create pre-sale action request.
     *
     * @param  CreatePreSaleActionRequestDto  $data  The pre-sale action data
     */
    public function __construct(
        public readonly CreatePreSaleActionRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return '/pre-sale-actions';
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return PreSaleActionDto The response DTO containing the created pre-sale action data
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
     * @return array<string, mixed> The request body containing the pre-sale action data
     */
    protected function defaultBody(): array
    {
        return $this->data->all();
    }
}
