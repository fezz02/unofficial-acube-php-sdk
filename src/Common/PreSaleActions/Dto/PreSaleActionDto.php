<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\PreSaleActions\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object representing a pre-sale action.
 *
 * This DTO represents a pre-sale action with information about thresholds,
 * action types, targets, and status.
 *
 * @see https://docs.acubeapi.com/documentation/common/pre-sale-actions/
 */
final readonly class PreSaleActionDto extends Dto
{
    /**
     * Create a new pre-sale action DTO.
     *
     * @param  string  $uuid  The unique identifier for the pre-sale action
     * @param  string  $created_at  ISO 8601 timestamp when the pre-sale action was created
     * @param  string  $updated_at  ISO 8601 timestamp when the pre-sale action was last updated
     * @param  int  $threshold  The threshold value for triggering the action
     * @param  string  $action_type  The type of action (e.g., "alert_mail")
     * @param  string  $target  The target for the action (e.g., email address)
     * @param  bool  $enabled  Whether the action is enabled
     * @param  bool  $running  Whether the action is currently running
     * @param  string  $pre_sale_uuid  The UUID of the associated pre-sale
     */
    public function __construct(
        public string $uuid,
        public string $created_at,
        public string $updated_at,
        public int $threshold,
        public string $action_type,
        public string $target,
        public bool $enabled,
        public bool $running,
        public string $pre_sale_uuid,
    ) {}
}
