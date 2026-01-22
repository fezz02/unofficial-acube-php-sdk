<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\User;

use Fezz\Acube\Sdk\BaseResource;
use Fezz\Acube\Sdk\Common\User\Dto\CreateUserSubAccountRequestDto;
use Fezz\Acube\Sdk\Common\User\Dto\UpdateSubAccountPasswordRequestDto;
use Fezz\Acube\Sdk\Common\User\Dto\UpdateUserPasswordRequestDto;
use Fezz\Acube\Sdk\Common\User\Dto\UpdateUserProfileRequestDto;
use Fezz\Acube\Sdk\Common\User\Dto\UpdateUserSubAccountRequestDto;
use Fezz\Acube\Sdk\Common\User\Requests\CreateUserSubAccountRequest;
use Fezz\Acube\Sdk\Common\User\Requests\DeleteUserSubAccountRequest;
use Fezz\Acube\Sdk\Common\User\Requests\GetUserProfileRequest;
use Fezz\Acube\Sdk\Common\User\Requests\GetUserSubAccountRequest;
use Fezz\Acube\Sdk\Common\User\Requests\GetUserSubAccountsRequest;
use Fezz\Acube\Sdk\Common\User\Requests\UpdateSubAccountPasswordRequest;
use Fezz\Acube\Sdk\Common\User\Requests\UpdateUserPasswordRequest;
use Fezz\Acube\Sdk\Common\User\Requests\UpdateUserProfileRequest;
use Fezz\Acube\Sdk\Common\User\Requests\UpdateUserSubAccountRequest;
use Saloon\Http\Response;

/**
 * User management API resource for the A-Cube Common API.
 *
 * Provides methods for managing user accounts, sub-accounts, and user profiles.
 *
 * @see https://docs.acubeapi.com/documentation/common/user/
 */
final class Api extends BaseResource
{
    /**
     * Get user sub accounts.
     *
     * Retrieves a collection of user sub-accounts associated with the authenticated user.
     *
     * Endpoint: GET /users/me/accounts
     *
     * @return Response The HTTP response containing the list of sub-accounts
     *
     * @see https://docs.acubeapi.com/documentation/common/user/#get-user-sub-accounts
     */
    public function subAccounts(): Response
    {
        return $this->connector->send(new GetUserSubAccountsRequest);
    }

    /**
     * Create a new user sub account.
     *
     * Creates a new sub-account for the authenticated user.
     *
     * Endpoint: POST /users/me/accounts
     *
     * @param  CreateUserSubAccountRequestDto  $dto  The sub-account data (email, password, fiscal_id, etc.)
     * @return Response The HTTP response containing the created sub-account
     *
     * @see https://docs.acubeapi.com/documentation/common/user/#create-user-sub-account
     */
    public function createSubAccount(CreateUserSubAccountRequestDto $dto): Response
    {
        return $this->connector->send(new CreateUserSubAccountRequest($dto));
    }

    /**
     * Get a user sub account by ID.
     *
     * Retrieves a specific sub-account by its ID.
     *
     * Endpoint: GET /users/me/accounts/{id}
     *
     * @param  string  $id  The sub-account ID
     * @return Response The HTTP response containing the sub-account data
     */
    public function getSubAccount(string $id): Response
    {
        return $this->connector->send(new GetUserSubAccountRequest($id));
    }

    /**
     * Update a user sub account.
     *
     * Updates an existing sub-account with new data.
     *
     * Endpoint: PUT /users/me/accounts/{id}
     *
     * @param  string  $id  The sub-account ID
     * @param  UpdateUserSubAccountRequestDto  $dto  The update payload
     * @return Response The HTTP response containing the updated sub-account data
     */
    public function updateSubAccount(string $id, UpdateUserSubAccountRequestDto $dto): Response
    {
        return $this->connector->send(new UpdateUserSubAccountRequest($id, $dto));
    }

    /**
     * Delete a user sub account.
     *
     * Deletes a sub-account by its ID.
     *
     * Endpoint: DELETE /users/me/accounts/{id}
     *
     * @param  string  $id  The sub-account ID
     * @return Response The HTTP response (204 on success, 404 if not found)
     */
    public function deleteSubAccount(string $id): Response
    {
        return $this->connector->send(new DeleteUserSubAccountRequest($id));
    }

    /**
     * Update a sub account password.
     *
     * Updates the password for a specific sub-account.
     *
     * Endpoint: PUT /users/me/accounts/{id}/change-password
     *
     * @param  UpdateSubAccountPasswordRequestDto  $dto  The password data including sub-account ID
     * @return Response The HTTP response containing the user profile with invoicing data
     */
    public function updateSubAccountPassword(UpdateSubAccountPasswordRequestDto $dto): Response
    {
        return $this->connector->send(new UpdateSubAccountPasswordRequest($dto));
    }

    /**
     * Get user profile.
     *
     * Retrieves a user profile by ID. Use "me" to get the current authenticated user's profile.
     *
     * Endpoint: GET /users/{id}
     *
     * @param  string  $id  The user ID (can be "me" for the current user, defaults to "me")
     * @return Response The HTTP response containing the user profile with invoicing data
     */
    public function getProfile(string $id = 'me'): Response
    {
        return $this->connector->send(new GetUserProfileRequest($id));
    }

    /**
     * Update user profile.
     *
     * Updates a user profile with invoicing information. Use "me" to update the current authenticated user's profile.
     *
     * Endpoint: PUT /users/{id}
     *
     * @param  string  $id  The user ID (can be "me" for the current user)
     * @param  UpdateUserProfileRequestDto  $dto  The update payload
     * @return Response The HTTP response containing the updated user profile with invoicing data
     */
    public function updateProfile(string $id, UpdateUserProfileRequestDto $dto): Response
    {
        return $this->connector->send(new UpdateUserProfileRequest($id, $dto));
    }

    /**
     * Update user password.
     *
     * Updates the password for a user. Use "me" to update the current authenticated user's password.
     *
     * Endpoint: PUT /users/{id}/change-password
     *
     * @param  UpdateUserPasswordRequestDto  $dto  The password data including user ID (defaults to "me")
     * @return Response The HTTP response containing the user profile with invoicing data
     */
    public function updatePassword(UpdateUserPasswordRequestDto $dto): Response
    {
        return $this->connector->send(new UpdateUserPasswordRequest($dto));
    }
}
