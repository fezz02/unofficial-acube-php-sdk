<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\ApiConfiguration;

use Fezz\Acube\Sdk\BaseResource;
use Fezz\Acube\Sdk\Italy\ApiConfiguration\Dto\CreateApiConfigurationRequestDto;
use Fezz\Acube\Sdk\Italy\ApiConfiguration\Dto\GetApiConfigurationsRequestDto;
use Fezz\Acube\Sdk\Italy\ApiConfiguration\Dto\UpdateApiConfigurationRequestDto;
use Fezz\Acube\Sdk\Italy\ApiConfiguration\Requests\CreateApiConfigurationRequest;
use Fezz\Acube\Sdk\Italy\ApiConfiguration\Requests\DeleteApiConfigurationRequest;
use Fezz\Acube\Sdk\Italy\ApiConfiguration\Requests\GetApiConfigurationRequest;
use Fezz\Acube\Sdk\Italy\ApiConfiguration\Requests\ListApiConfigurationsRequest;
use Fezz\Acube\Sdk\Italy\ApiConfiguration\Requests\UpdateApiConfigurationRequest;
use Saloon\Http\Response;

/**
 * API Configuration resource for the A-Cube Italy API.
 *
 * Provides methods for managing API configurations used for webhooks and integrations.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/
 */
final class Api extends BaseResource
{
    /**
     * List API configurations.
     *
     * Retrieves a collection of API configurations with optional filtering and pagination.
     *
     * Endpoint: GET /api-configurations
     *
     * @param  GetApiConfigurationsRequestDto  $dto  The request data including optional query parameters
     * @return Response The HTTP response containing the list of API configurations
     */
    public function list(GetApiConfigurationsRequestDto $dto): Response
    {
        return $this->connector->send(new ListApiConfigurationsRequest($dto));
    }

    /**
     * Get an API configuration by UUID.
     *
     * Endpoint: GET /api-configurations/{id}
     *
     * @param  string  $id  The API configuration UUID
     * @return Response The HTTP response containing the API configuration data
     */
    public function get(string $id): Response
    {
        return $this->connector->send(new GetApiConfigurationRequest($id));
    }

    /**
     * Create a new API configuration.
     *
     * Endpoint: POST /api-configurations
     *
     * @param  CreateApiConfigurationRequestDto  $dto  The request data including API configuration data
     * @return Response The HTTP response containing the created API configuration
     */
    public function create(CreateApiConfigurationRequestDto $dto): Response
    {
        return $this->connector->send(new CreateApiConfigurationRequest($dto));
    }

    /**
     * Update an existing API configuration.
     *
     * Endpoint: PUT /api-configurations/{id}
     *
     * @param  string  $id  The API configuration UUID
     * @param  UpdateApiConfigurationRequestDto  $dto  The request data including API configuration data
     * @return Response The HTTP response containing the updated API configuration
     */
    public function update(string $id, UpdateApiConfigurationRequestDto $dto): Response
    {
        return $this->connector->send(new UpdateApiConfigurationRequest($id, $dto));
    }

    /**
     * Delete an API configuration.
     *
     * Endpoint: DELETE /api-configurations/{id}
     *
     * @param  string  $id  The API configuration UUID
     * @return Response The HTTP response (204 on success, 404 if not found)
     */
    public function delete(string $id): Response
    {
        return $this->connector->send(new DeleteApiConfigurationRequest($id));
    }
}
