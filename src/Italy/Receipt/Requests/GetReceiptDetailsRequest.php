<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Receipt\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for getting receipt details or PDF.
 *
 * This request sends a GET request to retrieve receipt details or the PDF itself.
 *
 * Endpoint: GET /receipts/{id}/details
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/receipts/
 */
final class GetReceiptDetailsRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get receipt details request.
     *
     * @param  string  $id  The ID of the receipt
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
        return "/receipts/{$this->id}/details";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return array<string, mixed>|string The response data (details JSON or PDF content)
     */
    public function createDtoFromResponse(Response $response): array|string
    {
        $contentType = $response->header('Content-Type');
        $contentTypeString = '';
        if (is_string($contentType)) {
            $contentTypeString = $contentType;
        } elseif (is_array($contentType) && isset($contentType[0]) && is_string($contentType[0])) {
            $contentTypeString = $contentType[0];
        }

        if ($contentTypeString !== '' && str_contains($contentTypeString, 'application/json')) {
            /** @var array<string, mixed> $json */
            $json = $response->json();

            return $json;
        }

        return $response->body();
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
