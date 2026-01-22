<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\Subscriptions;

use Fezz\Acube\Sdk\BaseResource;
use Fezz\Acube\Sdk\Common\Subscriptions\Dto\CreateSubscriptionRequestDto;
use Fezz\Acube\Sdk\Common\Subscriptions\Dto\DeleteSubscriptionRequestDto;
use Fezz\Acube\Sdk\Common\Subscriptions\Dto\GetSubscriptionRequestDto;
use Fezz\Acube\Sdk\Common\Subscriptions\Dto\GetSubscriptionsRequestDto;
use Fezz\Acube\Sdk\Common\Subscriptions\Dto\RenewSubscriptionRequestDto;
use Fezz\Acube\Sdk\Common\Subscriptions\Dto\UpdateSubscriptionRequestDto;
use Fezz\Acube\Sdk\Common\Subscriptions\Requests\CreateSubscriptionRequest;
use Fezz\Acube\Sdk\Common\Subscriptions\Requests\DeleteSubscriptionRequest;
use Fezz\Acube\Sdk\Common\Subscriptions\Requests\GetSubscriptionRequest;
use Fezz\Acube\Sdk\Common\Subscriptions\Requests\GetSubscriptionsRequest;
use Fezz\Acube\Sdk\Common\Subscriptions\Requests\RenewSubscriptionRequest;
use Fezz\Acube\Sdk\Common\Subscriptions\Requests\UpdateSubscriptionRequest;
use Saloon\Http\Response;

/**
 * Subscriptions API resource for the A-Cube Common API.
 *
 * Provides methods for managing subscriptions.
 *
 * @see https://docs.acubeapi.com/documentation/common/subscriptions/
 */
final class Api extends BaseResource
{
    /**
     * List subscriptions.
     *
     * Retrieves a collection of subscriptions with optional filtering.
     *
     * Endpoint: GET /subscriptions
     *
     * @param  GetSubscriptionsRequestDto  $dto  The request data including optional query parameters
     * @return Response The HTTP response containing the list of subscriptions
     */
    public function list(GetSubscriptionsRequestDto $dto): Response
    {
        return $this->connector->send(new GetSubscriptionsRequest($dto));
    }

    /**
     * Get a subscription by UUID.
     *
     * Retrieves a specific subscription by its UUID.
     *
     * Endpoint: GET /subscriptions/{uuid}
     *
     * @param  GetSubscriptionRequestDto  $dto  The request data including subscription UUID
     * @return Response The HTTP response containing the subscription data
     */
    public function get(GetSubscriptionRequestDto $dto): Response
    {
        return $this->connector->send(new GetSubscriptionRequest($dto->uuid));
    }

    /**
     * Create a new subscription (admin only).
     *
     * Creates a new subscription. Requires admin role.
     *
     * Endpoint: POST /admin/subscriptions
     *
     * @param  CreateSubscriptionRequestDto  $dto  The subscription data
     * @return Response The HTTP response containing the created subscription
     */
    public function create(CreateSubscriptionRequestDto $dto): Response
    {
        return $this->connector->send(new CreateSubscriptionRequest($dto));
    }

    /**
     * Update a subscription (admin only).
     *
     * Updates an existing subscription. Requires admin role.
     *
     * Endpoint: PUT /admin/subscriptions/{uuid}
     *
     * @param  UpdateSubscriptionRequestDto  $dto  The update data including UUID
     * @return Response The HTTP response containing the updated subscription
     */
    public function update(UpdateSubscriptionRequestDto $dto): Response
    {
        return $this->connector->send(new UpdateSubscriptionRequest($dto));
    }

    /**
     * Delete a subscription (admin only).
     *
     * Schedules a subscription for deletion at the end of the current validity period.
     * Requires admin role.
     *
     * Endpoint: DELETE /admin/subscriptions/{uuid}
     *
     * @param  DeleteSubscriptionRequestDto  $dto  The request data including subscription UUID
     * @return Response The HTTP response (204 No Content on success)
     */
    public function delete(DeleteSubscriptionRequestDto $dto): Response
    {
        return $this->connector->send(new DeleteSubscriptionRequest($dto->uuid));
    }

    /**
     * Renew a subscription (admin only).
     *
     * Renews or hard-deletes a subscription. Requires admin role and should be used
     * by automated processes only.
     *
     * Endpoint: POST /admin/subscriptions/{uuid}/renew
     *
     * @param  RenewSubscriptionRequestDto  $dto  The request data including UUID
     * @return Response The HTTP response containing the renewed subscription
     */
    public function renew(RenewSubscriptionRequestDto $dto): Response
    {
        return $this->connector->send(new RenewSubscriptionRequest($dto));
    }
}
