<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\Subscriptions\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object representing a subscription.
 *
 * This DTO represents a subscription with information about its period,
 * status, limits, and renewal settings.
 *
 * @see https://docs.acubeapi.com/documentation/common/subscriptions/
 */
final readonly class SubscriptionDto extends Dto
{
    /**
     * Create a new subscription DTO.
     *
     * @param  string  $uuid  The unique identifier for the subscription
     * @param  string  $project_codename  The project codename associated with the subscription
     * @param  string|null  $fiscal_id  The fiscal identifier (tax ID, VAT number, etc.)
     * @param  bool  $active  Whether the subscription is currently active
     * @param  string  $period_starts_at  ISO 8601 timestamp when the subscription period starts
     * @param  string  $period_ends_at  ISO 8601 timestamp when the subscription period ends
     * @param  bool|null  $auto_renew  Whether the subscription will automatically renew
     * @param  string|null  $auto_renew_at  ISO 8601 timestamp when the subscription will auto-renew
     * @param  int|null  $limit  The subscription limit
     * @param  int|null  $count  The current count/usage
     * @param  bool  $deleted  Whether the subscription has been deleted
     */
    public function __construct(
        public string $uuid,
        public string $project_codename,
        public ?string $fiscal_id,
        public bool $active,
        public string $period_starts_at,
        public string $period_ends_at,
        public ?bool $auto_renew,
        public ?string $auto_renew_at,
        public ?int $limit,
        public ?int $count,
        public bool $deleted,
    ) {}
}
