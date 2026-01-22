<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\Subscriptions\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for getting a list of subscriptions.
 *
 * This DTO contains optional query parameters for filtering and pagination.
 *
 * @see https://docs.acubeapi.com/documentation/common/subscriptions/
 */
final readonly class GetSubscriptionsRequestDto extends Dto
{
    /**
     * Create a new get subscriptions request DTO.
     *
     * @param  array<string, mixed>  $query  Optional query parameters (page, active, period_starts_at, etc.)
     */
    public function __construct(
        public array $query = []
    ) {}
}
