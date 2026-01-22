<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\Subscriptions\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for deleting a subscription by UUID.
 */
final readonly class DeleteSubscriptionRequestDto extends Dto
{
    public function __construct(
        public string $uuid,
    ) {}
}
