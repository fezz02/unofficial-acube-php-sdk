<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\NumberingSequence\Requests;

use Fezz\Acube\Sdk\Italy\NumberingSequence\Dto\NumberingSequenceDto;
use Fezz\Acube\Sdk\Italy\NumberingSequence\Dto\UpdateNumberingSequenceRequestDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Request for updating a numbering sequence.
 *
 * This request sends a PUT request to update an existing numbering sequence.
 *
 * Endpoint: PUT /numbering-sequences/{id}
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/numbering-sequences/
 */
final class UpdateNumberingSequenceRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    /**
     * Create a new update numbering sequence request.
     *
     * @param  UpdateNumberingSequenceRequestDto  $data  The request data including ID and sequence data
     */
    public function __construct(
        public readonly UpdateNumberingSequenceRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/numbering-sequences/{$this->data->id}";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return NumberingSequenceDto The response DTO containing the updated numbering sequence
     */
    public function createDtoFromResponse(Response $response): NumberingSequenceDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return NumberingSequenceDto::from($json);
    }

    /**
     * Get the default body for the request.
     *
     * @return array<string, mixed> The request body containing the sequence data
     */
    protected function defaultBody(): array
    {
        return $this->data->sequence;
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
}
