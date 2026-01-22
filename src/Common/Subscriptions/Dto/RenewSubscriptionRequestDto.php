<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\Subscriptions\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for renewing a subscription (admin only).
 *
 * This DTO encapsulates the UUID for renewing a subscription.
 * The request body is empty according to the OpenAPI spec.
 *
 * @see https://docs.acubeapi.com/documentation/common/subscriptions/
 */
final readonly class RenewSubscriptionRequestDto extends Dto
{
    /**
     * Create a new renew subscription request DTO.
     *
     * @param  string  $uuid  The UUID of the subscription to renew
     */
    public function __construct(
        public string $uuid
    ) {}
}
