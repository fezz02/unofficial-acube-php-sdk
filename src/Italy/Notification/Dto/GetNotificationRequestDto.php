<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Notification\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for getting a single notification by UUID.
 *
 * This DTO encapsulates the notification UUID path parameter.
 */
final readonly class GetNotificationRequestDto extends Dto
{
    /**
     * Create a new get notification request DTO.
     *
     * @param  string  $uuid  The notification UUID
     */
    public function __construct(
        public string $uuid,
    ) {}
}
