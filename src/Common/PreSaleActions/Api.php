<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\PreSaleActions;

use Fezz\Acube\Sdk\BaseResource;
use Fezz\Acube\Sdk\Common\PreSaleActions\Dto\CreatePreSaleActionRequestDto;
use Fezz\Acube\Sdk\Common\PreSaleActions\Dto\GetPreSaleActionsRequestDto;
use Fezz\Acube\Sdk\Common\PreSaleActions\Dto\UpdatePreSaleActionRequestDto;
use Fezz\Acube\Sdk\Common\PreSaleActions\Requests\CreatePreSaleActionRequest;
use Fezz\Acube\Sdk\Common\PreSaleActions\Requests\DeletePreSaleActionRequest;
use Fezz\Acube\Sdk\Common\PreSaleActions\Requests\GetPreSaleActionRequest;
use Fezz\Acube\Sdk\Common\PreSaleActions\Requests\GetPreSaleActionsRequest;
use Fezz\Acube\Sdk\Common\PreSaleActions\Requests\UpdatePreSaleActionRequest;
use Saloon\Http\Response;

/**
 * Pre-sale actions API resource for the A-Cube Common API.
 *
 * Provides methods for managing pre-sale actions.
 *
 * @see https://docs.acubeapi.com/documentation/common/pre-sale-actions/
 */
final class Api extends BaseResource
{
    /**
     * List pre-sale actions.
     *
     * Retrieves a collection of pre-sale actions.
     *
     * Endpoint: GET /pre-sale-actions
     *
     * @param  GetPreSaleActionsRequestDto  $dto  The request data including optional query parameters
     * @return Response The HTTP response containing the list of pre-sale actions
     */
    public function list(GetPreSaleActionsRequestDto $dto): Response
    {
        return $this->connector->send(new GetPreSaleActionsRequest($dto));
    }

    /**
     * Get a pre-sale action by UUID.
     *
     * Retrieves a specific pre-sale action by its UUID.
     *
     * Endpoint: GET /pre-sale-actions/{uuid}
     *
     * @param  string  $uuid  The pre-sale action UUID
     * @return Response The HTTP response containing the pre-sale action data
     */
    public function get(string $uuid): Response
    {
        return $this->connector->send(new GetPreSaleActionRequest($uuid));
    }

    /**
     * Create a new pre-sale action.
     *
     * Creates a new pre-sale action.
     *
     * Endpoint: POST /pre-sale-actions
     *
     * @param  CreatePreSaleActionRequestDto  $dto  The pre-sale action data
     * @return Response The HTTP response containing the created pre-sale action data
     */
    public function create(CreatePreSaleActionRequestDto $dto): Response
    {
        return $this->connector->send(new CreatePreSaleActionRequest($dto));
    }

    /**
     * Update a pre-sale action.
     *
     * Updates an existing pre-sale action.
     *
     * Endpoint: PUT /pre-sale-actions/{uuid}
     *
     * @param  string  $uuid  The pre-sale action UUID
     * @param  UpdatePreSaleActionRequestDto  $dto  The update payload
     * @return Response The HTTP response containing the updated pre-sale action data
     */
    public function update(string $uuid, UpdatePreSaleActionRequestDto $dto): Response
    {
        return $this->connector->send(new UpdatePreSaleActionRequest($uuid, $dto));
    }

    /**
     * Delete a pre-sale action.
     *
     * Deletes a pre-sale action by its UUID.
     *
     * Endpoint: DELETE /pre-sale-actions/{uuid}
     *
     * @param  string  $uuid  The pre-sale action UUID
     * @return Response The HTTP response (204 on success, 404 if not found)
     */
    public function delete(string $uuid): Response
    {
        return $this->connector->send(new DeletePreSaleActionRequest($uuid));
    }
}
