<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\PreservedDocument\Requests;

use Fezz\Acube\Sdk\Italy\PreservedDocument\Dto\GetPreservedDocumentsRequestDto;
use Fezz\Acube\Sdk\Italy\PreservedDocument\Dto\PreservedDocumentDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for listing preserved documents.
 *
 * This request sends a GET request to retrieve a collection of preserved documents.
 *
 * Endpoint: GET /preserved-documents
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/preserved-documents/
 */
final class GetPreservedDocumentsRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get preserved documents request.
     *
     * @param  GetPreservedDocumentsRequestDto  $data  The request data including optional query parameters
     */
    public function __construct(
        public readonly GetPreservedDocumentsRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return '/preserved-documents';
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return array<int, PreservedDocumentDto> The response DTO containing the list of preserved documents
     */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<int, array<string, mixed>> $json */
        $json = $response->json();

        return array_map(
            PreservedDocumentDto::from(...),
            $json
        );
    }

    /**
     * Get the query parameters for the request.
     *
     * @return array<string, mixed> The query parameters
     */
    protected function defaultQuery(): array
    {
        return $this->data->query;
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
