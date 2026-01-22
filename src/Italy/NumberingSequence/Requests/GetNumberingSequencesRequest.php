<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\NumberingSequence\Requests;

use Fezz\Acube\Sdk\Italy\NumberingSequence\Dto\GetNumberingSequencesRequestDto;
use Fezz\Acube\Sdk\Italy\NumberingSequence\Dto\NumberingSequenceDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for listing numbering sequences.
 *
 * This request sends a GET request to retrieve a collection of numbering sequences
 * with optional query parameters for filtering.
 *
 * Endpoint: GET /numbering-sequences
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/numbering-sequences/
 */
final class GetNumberingSequencesRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get numbering sequences request.
     *
     * @param  GetNumberingSequencesRequestDto  $data  The request data including optional query parameters
     */
    public function __construct(
        public readonly GetNumberingSequencesRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return '/numbering-sequences';
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return array<int, NumberingSequenceDto> The response DTO containing the list of numbering sequences
     */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<int, array<string, mixed>> $json */
        $json = $response->json();

        return array_map(
            NumberingSequenceDto::from(...),
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
