<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\NumberingSequence\Requests;

use Fezz\Acube\Sdk\Italy\NumberingSequence\Dto\GetNumberingSequenceRequestDto;
use Fezz\Acube\Sdk\Italy\NumberingSequence\Dto\NumberingSequenceDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for retrieving a single numbering sequence by ID.
 *
 * This request sends a GET request to retrieve a specific numbering sequence by its ID.
 *
 * Endpoint: GET /numbering-sequences/{id}
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/numbering-sequences/
 */
final class GetNumberingSequenceRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        public readonly GetNumberingSequenceRequestDto $dto,
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/numbering-sequences/{$this->dto->id}";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return NumberingSequenceDto The response DTO containing the numbering sequence data
     */
    public function createDtoFromResponse(Response $response): NumberingSequenceDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return NumberingSequenceDto::from($json);
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
