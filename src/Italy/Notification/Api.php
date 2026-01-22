<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Notification;

use Fezz\Acube\Sdk\BaseResource;
use Fezz\Acube\Sdk\Italy\Notification\Dto\MarkNotificationsDownloadedRequestDto;
use Fezz\Acube\Sdk\Italy\Notification\Requests\GetNotificationRequest;
use Fezz\Acube\Sdk\Italy\Notification\Requests\MarkNotificationsDownloadedRequest;
use Saloon\Http\Response;

/**
 * Notifications API resource for the A-Cube Italy API.
 *
 * Provides methods for managing invoice notifications.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/notifications/
 */
final class Api extends BaseResource
{
    /**
     * Get a notification by UUID.
     *
     * Retrieves a specific notification by its UUID.
     *
     * Endpoint: GET /notifications/{uuid}
     *
     * @param  Dto\GetNotificationRequestDto  $dto  The request data including notification UUID
     * @return Response The HTTP response containing the notification data
     */
    public function get(Dto\GetNotificationRequestDto $dto): Response
    {
        return $this->connector->send(new GetNotificationRequest($dto));
    }

    /**
     * Mark notifications as downloaded.
     *
     * Sets the downloaded flag for a collection of notifications.
     *
     * Endpoint: POST /notifications/downloaded
     *
     * @param  MarkNotificationsDownloadedRequestDto  $dto  The request data including notification UUIDs
     * @return Response The HTTP response
     */
    public function markDownloaded(MarkNotificationsDownloadedRequestDto $dto): Response
    {
        return $this->connector->send(new MarkNotificationsDownloadedRequest($dto));
    }
}
