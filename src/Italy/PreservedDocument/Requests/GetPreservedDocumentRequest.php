<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\PreservedDocument\Requests;

use Fezz\Acube\Sdk\Italy\PreservedDocument\Dto\GetPreservedDocumentRequestDto;
use Fezz\Acube\Sdk\Italy\PreservedDocument\Dto\PreservedDocumentDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for retrieving a single preserved document by ID.
 *
 * This request sends a GET request to retrieve a specific preserved document by its ID.
 *
 * Endpoint: GET /preserved-documents/{id}
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/preserved-documents/
 */
final class GetPreservedDocumentRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get preserved document request.
     *
     * @param  GetPreservedDocumentRequestDto  $dto  The request data including preserved document ID
     */
    public function __construct(
        public readonly GetPreservedDocumentRequestDto $dto,
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/preserved-documents/{$this->dto->id}";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return PreservedDocumentDto The response DTO containing the preserved document data
     */
    public function createDtoFromResponse(Response $response): PreservedDocumentDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return PreservedDocumentDto::from($json);
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
