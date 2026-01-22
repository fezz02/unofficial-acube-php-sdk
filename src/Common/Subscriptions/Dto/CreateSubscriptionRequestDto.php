<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\Subscriptions\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for creating a subscription (admin only).
 *
 * This DTO encapsulates the request body for creating a new subscription.
 *
 * @see https://docs.acubeapi.com/documentation/common/subscriptions/
 */
final readonly class CreateSubscriptionRequestDto extends Dto
{
    /**
     * Create a new create subscription request DTO.
     *
     * @param  string  $project_codename  The project codename
     * @param  int  $limit  The subscription limit
     * @param  bool  $active  Whether the subscription is active
     * @param  bool  $auto_renew  Whether the subscription should auto-renew
     * @param  string  $duration  The subscription duration (e.g., "1Y", "6M")
     * @param  string|null  $fiscal_id  The fiscal identifier (optional)
     */
    public function __construct(
        public string $project_codename,
        public int $limit,
        public bool $active,
        public bool $auto_renew,
        public string $duration,
        public ?string $fiscal_id = null,
    ) {}
}
