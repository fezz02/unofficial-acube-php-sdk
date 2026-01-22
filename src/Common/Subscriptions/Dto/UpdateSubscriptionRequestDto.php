<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\Subscriptions\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for updating a subscription (admin only).
 *
 * This DTO encapsulates the request body and UUID for updating a subscription.
 *
 * @see https://docs.acubeapi.com/documentation/common/subscriptions/
 */
final readonly class UpdateSubscriptionRequestDto extends Dto
{
    /**
     * Create a new update subscription request DTO.
     *
     * @param  string  $uuid  The UUID of the subscription to update
     * @param  int|null  $limit  The subscription limit (optional)
     * @param  bool|null  $active  Whether the subscription is active (optional)
     * @param  bool|null  $auto_renew  Whether the subscription should auto-renew (optional)
     */
    public function __construct(
        public string $uuid,
        public ?int $limit = null,
        public ?bool $active = null,
        public ?bool $auto_renew = null,
    ) {}
}
