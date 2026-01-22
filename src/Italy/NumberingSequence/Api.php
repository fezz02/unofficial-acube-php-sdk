<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\NumberingSequence;

use Fezz\Acube\Sdk\BaseResource;
use Fezz\Acube\Sdk\Italy\NumberingSequence\Dto\CreateNumberingSequenceRequestDto;
use Fezz\Acube\Sdk\Italy\NumberingSequence\Requests\CreateNumberingSequenceRequest;
use Saloon\Http\Response;

/**
 * Numbering sequences API resource for the A-Cube Italy API.
 *
 * Provides methods for managing numbering sequences used for automatic
 * invoice numbering.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/numbering-sequences/
 */
final class Api extends BaseResource
{
    /**
     * Create a numbering sequence.
     *
     * Creates a new numbering sequence for automatic invoice numbering.
     *
     * Endpoint: POST /numbering-sequences
     *
     * @param  CreateNumberingSequenceRequestDto  $dto  The sequence data
     * @return Response The HTTP response containing the created sequence
     */
    public function create(CreateNumberingSequenceRequestDto $dto): Response
    {
        return $this->connector->send(new CreateNumberingSequenceRequest($dto));
    }

    /**
     * List numbering sequences.
     *
     * Retrieves a collection of numbering sequences with optional filtering.
     *
     * Endpoint: GET /numbering-sequences
     *
     * @param  Dto\GetNumberingSequencesRequestDto  $dto  The request data including optional query parameters
     * @return Response The HTTP response containing the list of numbering sequences
     */
    public function list(Dto\GetNumberingSequencesRequestDto $dto): Response
    {
        return $this->connector->send(new Requests\GetNumberingSequencesRequest($dto));
    }

    /**
     * Get a numbering sequence by ID.
     *
     * Retrieves a specific numbering sequence by its ID.
     *
     * Endpoint: GET /numbering-sequences/{id}
     *
     * @param  Dto\GetNumberingSequenceRequestDto  $dto  The request data including ID
     * @return Response The HTTP response containing the numbering sequence data
     */
    public function get(Dto\GetNumberingSequenceRequestDto $dto): Response
    {
        return $this->connector->send(new Requests\GetNumberingSequenceRequest($dto));
    }

    /**
     * Update a numbering sequence.
     *
     * Updates an existing numbering sequence.
     *
     * Endpoint: PUT /numbering-sequences/{id}
     *
     * @param  Dto\UpdateNumberingSequenceRequestDto  $dto  The update data including ID
     * @return Response The HTTP response containing the updated numbering sequence
     */
    public function update(Dto\UpdateNumberingSequenceRequestDto $dto): Response
    {
        return $this->connector->send(new Requests\UpdateNumberingSequenceRequest($dto));
    }

    /**
     * Delete a numbering sequence.
     *
     * Deletes a numbering sequence by its ID.
     *
     * Endpoint: DELETE /numbering-sequences/{id}
     *
     * @param  Dto\DeleteNumberingSequenceRequestDto  $dto  The request data including ID
     * @return Response The HTTP response (204 on success, 404 if not found)
     */
    public function delete(Dto\DeleteNumberingSequenceRequestDto $dto): Response
    {
        return $this->connector->send(new Requests\DeleteNumberingSequenceRequest($dto->id));
    }

    /**
     * Get the current numbering sequence by name.
     *
     * Retrieves the numbering sequence that is currently used for a given sequence name.
     *
     * Endpoint: GET /numbering-sequences/current/{name}
     *
     * @param  Dto\GetCurrentNumberingSequenceRequestDto  $dto  The request data including name
     * @return Response The HTTP response containing the current numbering sequence
     */
    public function getCurrent(Dto\GetCurrentNumberingSequenceRequestDto $dto): Response
    {
        return $this->connector->send(new Requests\GetCurrentNumberingSequenceRequest($dto));
    }

    /**
     * Update the current numbering sequence by name.
     *
     * Creates or updates the numbering sequence that is currently used for a given sequence name.
     *
     * Endpoint: PUT /numbering-sequences/current/{name}
     *
     * @param  Dto\UpdateCurrentNumberingSequenceRequestDto  $dto  The request data including name and sequence data
     * @return Response The HTTP response containing the updated numbering sequence
     */
    public function updateCurrent(Dto\UpdateCurrentNumberingSequenceRequestDto $dto): Response
    {
        return $this->connector->send(new Requests\UpdateCurrentNumberingSequenceRequest($dto));
    }
}
