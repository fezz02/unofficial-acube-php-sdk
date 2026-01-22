<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\NumberingSequence\Requests;

use Fezz\Acube\Sdk\Italy\NumberingSequence\Dto\CreateNumberingSequenceRequestDto;
use Fezz\Acube\Sdk\Italy\NumberingSequence\Dto\NumberingSequenceDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Request for creating a numbering sequence.
 *
 * This request sends a POST request to create a new numbering sequence
 * for automatic invoice numbering.
 *
 * Endpoint: POST /numbering-sequences
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/numbering-sequences/
 */
final class CreateNumberingSequenceRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * Create a new create numbering sequence request.
     *
     * @param  CreateNumberingSequenceRequestDto  $data  The sequence data
     */
    public function __construct(
        public readonly CreateNumberingSequenceRequestDto $data
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
     * @return NumberingSequenceDto The response DTO containing the created sequence
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
            'Content-Type' => 'application/json',
        ];
    }

    /**
     * Get the default body for the request.
     *
     * @return array<string, mixed> The request body containing the sequence data
     */
    protected function defaultBody(): array
    {
        return $this->data->all();
    }
}
