<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\PreservedDocument\Requests;

use Fezz\Acube\Sdk\Italy\PreservedDocument\Dto\GetPreservedDocumentReceiptRequestDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for getting a preserved document receipt.
 *
 * This request sends a GET request to retrieve the XML receipt for a preserved document.
 *
 * Endpoint: GET /preserved-documents/{uuid}/receipt
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/preserved-documents/
 */
final class GetPreservedDocumentReceiptRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get preserved document receipt request.
     *
     * @param  GetPreservedDocumentReceiptRequestDto  $data  The request data including UUID
     */
    public function __construct(
        public readonly GetPreservedDocumentReceiptRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/preserved-documents/{$this->data->uuid}/receipt";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return string The XML receipt content
     */
    public function createDtoFromResponse(Response $response): string
    {
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
            'Accept' => 'application/xml',
        ];
    }
}
