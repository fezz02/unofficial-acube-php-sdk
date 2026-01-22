<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry;

use Fezz\Acube\Sdk\BaseResource;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\AddSubAccountRequestDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\AppointFisconlineRequestDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\AppointSpidRequestDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\CreateBusinessRegistryConfigurationRequestDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\CreateBusinessRegistryRequestDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\GetBusinessRegistriesRequestDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\GetBusinessRegistryConfigurationsRequestDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\RemoveSubAccountRequestDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\SetAdeCredentialsRequestDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\UpdateBusinessRegistryConfigurationRequestDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\UpdateBusinessRegistryRequestDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\UpdateReceiptSettingsRequestDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\UpdateReportingRequestDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\AddSubAccountRequest;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\AppointFisconlineRequest;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\AppointSpidRequest;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\CreateBusinessRegistryConfigurationRequest;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\CreateBusinessRegistryRequest;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\DeleteBusinessRegistryConfigurationRequest;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\DeleteBusinessRegistryRequest;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\GetAppointStatusRequest;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\GetBusinessRegistriesRequest;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\GetBusinessRegistryConfigurationRequest;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\GetBusinessRegistryConfigurationsRequest;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\GetBusinessRegistryRequest;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\GetReceiptSettingsRequest;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\GetReportingRequest;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\ListSubAccountsRequest;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\RemoveSubAccountRequest;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\ResetLegalStoragePasswordRequest;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\SetAdeCredentialsRequest;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\UpdateBusinessRegistryConfigurationRequest;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\UpdateBusinessRegistryRequest;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\UpdateReceiptSettingsRequest;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\UpdateReportingRequest;
use Saloon\Http\Response;

/**
 * Business Registry API resource for the A-Cube Italy API.
 *
 * Provides methods for managing business registry entries and business registry configurations.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry/
 */
final class Api extends BaseResource
{
    /**
     * List business registries.
     *
     * Retrieves a collection of business registry entries with optional filtering and pagination.
     *
     * Endpoint: GET /business-registries
     *
     * @param  GetBusinessRegistriesRequestDto  $dto  The request data including optional query parameters
     * @return Response The HTTP response containing the list of business registries
     */
    public function list(GetBusinessRegistriesRequestDto $dto): Response
    {
        return $this->connector->send(new GetBusinessRegistriesRequest($dto));
    }

    /**
     * Create a business registry entry.
     *
     * Creates a new business registry entry.
     *
     * Endpoint: POST /business-registries
     *
     * @param  CreateBusinessRegistryRequestDto  $dto  The request data including business registry data
     * @return Response The HTTP response containing the created business registry
     */
    public function create(CreateBusinessRegistryRequestDto $dto): Response
    {
        return $this->connector->send(new CreateBusinessRegistryRequest($dto));
    }

    /**
     * Get a business registry entry by ID.
     *
     * Retrieves a specific business registry entry by its ID.
     *
     * Endpoint: GET /business-registries/{id}
     *
     * @param  string  $id  The ID of the business registry entry
     * @return Response The HTTP response containing the business registry data
     */
    public function get(string $id): Response
    {
        return $this->connector->send(new GetBusinessRegistryRequest($id));
    }

    /**
     * Update a business registry entry.
     *
     * Replaces an existing business registry entry.
     *
     * Endpoint: PUT /business-registries/{id}
     *
     * @param  string  $id  The ID of the business registry entry
     * @param  UpdateBusinessRegistryRequestDto  $dto  The body data including business registry data
     * @return Response The HTTP response containing the updated business registry
     */
    public function update(string $id, UpdateBusinessRegistryRequestDto $dto): Response
    {
        return $this->connector->send(new UpdateBusinessRegistryRequest($id, $dto));
    }

    /**
     * Delete a business registry entry.
     *
     * Removes a business registry entry.
     *
     * Endpoint: DELETE /business-registries/{id}
     *
     * @param  string  $id  The ID of the business registry entry
     * @return Response The HTTP response (204 on success, 404 if not found)
     */
    public function delete(string $id): Response
    {
        return $this->connector->send(new DeleteBusinessRegistryRequest($id));
    }

    /**
     * List business registry configurations.
     *
     * Retrieves a collection of business registry configurations with optional filtering and pagination.
     *
     * Endpoint: GET /business-registry-configurations
     *
     * @param  GetBusinessRegistryConfigurationsRequestDto  $dto  The request data including optional query parameters
     * @return Response The HTTP response containing the list of business registry configurations
     */
    public function listConfigurations(GetBusinessRegistryConfigurationsRequestDto $dto): Response
    {
        return $this->connector->send(new GetBusinessRegistryConfigurationsRequest($dto));
    }

    /**
     * Create a business registry configuration.
     *
     * Creates a new business registry configuration.
     *
     * Endpoint: POST /business-registry-configurations
     *
     * @param  CreateBusinessRegistryConfigurationRequestDto  $dto  The request data including business registry configuration data
     * @return Response The HTTP response containing the created business registry configuration
     */
    public function createConfiguration(CreateBusinessRegistryConfigurationRequestDto $dto): Response
    {
        return $this->connector->send(new CreateBusinessRegistryConfigurationRequest($dto));
    }

    /**
     * Get a business registry configuration by fiscal identifier.
     *
     * Retrieves a specific business registry configuration by its fiscal identifier.
     *
     * Endpoint: GET /business-registry-configurations/{id}
     *
     * @param  string  $id  The fiscal identifier of the Business Registry Configuration
     * @return Response The HTTP response containing the business registry configuration data
     */
    public function getConfiguration(string $id): Response
    {
        return $this->connector->send(new GetBusinessRegistryConfigurationRequest($id));
    }

    /**
     * Update a business registry configuration.
     *
     * Updates an existing business registry configuration.
     *
     * Endpoint: PUT /business-registry-configurations/{id}
     *
     * @param  string  $id  The fiscal identifier of the Business Registry Configuration
     * @param  UpdateBusinessRegistryConfigurationRequestDto  $dto  The body data including business registry configuration data
     * @return Response The HTTP response containing the updated business registry configuration
     */
    public function updateConfiguration(string $id, UpdateBusinessRegistryConfigurationRequestDto $dto): Response
    {
        return $this->connector->send(new UpdateBusinessRegistryConfigurationRequest($id, $dto));
    }

    /**
     * Delete a business registry configuration.
     *
     * Removes a business registry configuration.
     *
     * Endpoint: DELETE /business-registry-configurations/{id}
     *
     * @param  string  $id  The fiscal identifier of the Business Registry Configuration
     * @return Response The HTTP response (204 on success, 404 if not found)
     */
    public function deleteConfiguration(string $id): Response
    {
        return $this->connector->send(new DeleteBusinessRegistryConfigurationRequest($id));
    }

    /**
     * Appoint A-Cube to use receipt services via FiscOnline/Entratel.
     *
     * Appoints A-Cube to use the receipt services on the Agenzia delle Entrate portal using FiscOnline / Entratel credentials.
     *
     * Endpoint: PUT /business-registry-configurations/{id}/appoint/fisconline
     *
     * @param  AppointFisconlineRequestDto  $dto  The request data including fiscal identifier and credentials
     * @return Response The HTTP response (204 on success)
     */
    public function appointFisconline(AppointFisconlineRequestDto $dto): Response
    {
        return $this->connector->send(new AppointFisconlineRequest($dto));
    }

    /**
     * Appoint a 3rd party person to use receipt services via SPID.
     *
     * Appoints a 3rd party person to use the receipt services on the Agenzia delle Entrate portal with SPID credentials.
     *
     * Endpoint: PUT /business-registry-configurations/{id}/appoint/spid
     *
     * @param  AppointSpidRequestDto  $dto  The request data including fiscal identifier and appointing person data
     * @return Response The HTTP response containing the URL for the appointing process
     */
    public function appointSpid(AppointSpidRequestDto $dto): Response
    {
        return $this->connector->send(new AppointSpidRequest($dto));
    }

    /**
     * Get the status of an appointing request.
     *
     * Gets the status of an appointing request for a business registry configuration.
     *
     * Endpoint: GET /business-registry-configurations/{id}/appoint/status
     *
     * @param  string  $id  The fiscal identifier of the Business Registry Configuration
     * @return Response The HTTP response containing the appoint status
     */
    public function getAppointStatus(string $id): Response
    {
        return $this->connector->send(new GetAppointStatusRequest($id));
    }

    /**
     * Set Agenzia delle Entrate credentials.
     *
     * Updates the credentials to access the Agenzia delle Entrate portal (FiscOnline / Entratel).
     *
     * Endpoint: PUT /business-registry-configurations/{id}/credentials/fisconline
     *
     * @param  SetAdeCredentialsRequestDto  $dto  The request data including fiscal identifier and credentials
     * @return Response The HTTP response (204 on success)
     */
    public function setAdeCredentials(SetAdeCredentialsRequestDto $dto): Response
    {
        return $this->connector->send(new SetAdeCredentialsRequest($dto));
    }

    /**
     * Get receipt settings.
     *
     * Gets settings related to Smart Receipts for a business registry configuration.
     *
     * Endpoint: GET /business-registry-configurations/{id}/receipt-settings
     *
     * @param  string  $id  The fiscal identifier of the Business Registry Configuration
     * @return Response The HTTP response containing the receipt settings
     */
    public function getReceiptSettings(string $id): Response
    {
        return $this->connector->send(new GetReceiptSettingsRequest($id));
    }

    /**
     * Update receipt settings.
     *
     * Updates settings related to Smart Receipts for a business registry configuration.
     *
     * Endpoint: PUT /business-registry-configurations/{id}/receipt-settings
     *
     * @param  string  $id  The fiscal identifier of the Business Registry Configuration
     * @param  UpdateReceiptSettingsRequestDto  $dto  The body data including receipt settings
     * @return Response The HTTP response containing the updated receipt settings
     */
    public function updateReceiptSettings(string $id, UpdateReceiptSettingsRequestDto $dto): Response
    {
        return $this->connector->send(new UpdateReceiptSettingsRequest($id, $dto));
    }

    /**
     * Get reporting parameters.
     *
     * Gets reporting parameters for a business registry configuration.
     *
     * Endpoint: GET /business-registry-configurations/{id}/reporting
     *
     * @param  string  $id  The fiscal identifier of the Business Registry Configuration
     * @return Response The HTTP response containing the reporting parameters
     */
    public function getReporting(string $id): Response
    {
        return $this->connector->send(new GetReportingRequest($id));
    }

    /**
     * Update reporting parameters.
     *
     * Replaces reporting parameters for a business registry configuration.
     *
     * Endpoint: PUT /business-registry-configurations/{id}/reporting
     *
     * @param  string  $id  The fiscal identifier of the Business Registry Configuration
     * @param  UpdateReportingRequestDto  $dto  The body data including reporting parameters
     * @return Response The HTTP response containing the updated reporting parameters
     */
    public function updateReporting(string $id, UpdateReportingRequestDto $dto): Response
    {
        return $this->connector->send(new UpdateReportingRequest($id, $dto));
    }

    /**
     * Reset legal storage portal password.
     *
     * Asks to reset legal storage portal password for the provided fiscal identifier.
     *
     * Endpoint: GET /business-registry-configurations/{id}/reset-legal-storage-password
     *
     * @param  string  $id  The fiscal identifier of the Business Registry Configuration
     * @return Response The HTTP response (200 on success)
     */
    public function resetLegalStoragePassword(string $id): Response
    {
        return $this->connector->send(new ResetLegalStoragePasswordRequest($id));
    }

    /**
     * List sub accounts.
     *
     * Lists all sub accounts connected to the provided fiscal identifier.
     *
     * Endpoint: GET /business-registry-configurations/{id}/sub-accounts
     *
     * @param  string  $id  The fiscal identifier of the Business Registry Configuration
     * @return Response The HTTP response containing the list of sub accounts
     */
    public function listSubAccounts(string $id): Response
    {
        return $this->connector->send(new ListSubAccountsRequest($id));
    }

    /**
     * Add a sub account.
     *
     * Adds a new sub account to the provided fiscal identifier.
     *
     * Endpoint: POST /business-registry-configurations/{id}/sub-accounts
     *
     * @param  AddSubAccountRequestDto  $dto  The request data including fiscal identifier and sub account data
     * @return Response The HTTP response containing the created sub account
     */
    public function addSubAccount(AddSubAccountRequestDto $dto): Response
    {
        return $this->connector->send(new AddSubAccountRequest($dto));
    }

    /**
     * Remove a sub account.
     *
     * Removes a sub account from the provided fiscal identifier.
     *
     * Endpoint: DELETE /business-registry-configurations/{id}/sub-accounts/{email}
     *
     * @param  RemoveSubAccountRequestDto  $dto  The request data including fiscal identifier and email
     * @return Response The HTTP response (204 on success, 404 if not found)
     */
    public function removeSubAccount(RemoveSubAccountRequestDto $dto): Response
    {
        return $this->connector->send(new RemoveSubAccountRequest($dto));
    }
}
