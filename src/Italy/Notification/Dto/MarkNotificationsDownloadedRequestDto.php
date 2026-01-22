<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Notification\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for marking notifications as downloaded.
 *
 * This DTO encapsulates the notification UUIDs to mark as downloaded.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/notifications/
 */
final readonly class MarkNotificationsDownloadedRequestDto extends Dto
{
    /**
     * Create a new mark notifications downloaded request DTO.
     *
     * @param  array<string>  $uuids  Array of notification UUIDs to mark as downloaded
     */
    public function __construct(
        public array $uuids
    ) {}
}
