<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Receipt\Requests;

use Fezz\Acube\Sdk\Italy\Receipt\Dto\ReceiptDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for retrieving a single receipt by ID.
 *
 * This request sends a GET request to retrieve a specific receipt by its ID.
 *
 * Endpoint: GET /receipts/{id}
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/receipts/
 */
final class GetReceiptRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get receipt request.
     *
     * @param  string  $id  The ID of the receipt to retrieve
     */
    public function __construct(
        public readonly string $id
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/receipts/{$this->id}";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return ReceiptDto The response DTO containing the receipt data
     */
    public function createDtoFromResponse(Response $response): ReceiptDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return ReceiptDto::from($json);
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
