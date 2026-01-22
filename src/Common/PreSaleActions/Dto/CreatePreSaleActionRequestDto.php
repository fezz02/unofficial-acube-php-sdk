<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\PreSaleActions\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for creating a pre-sale action.
 *
 * This DTO contains the data required to create a new pre-sale action.
 *
 * @see https://docs.acubeapi.com/documentation/common/pre-sale-actions/
 */
final readonly class CreatePreSaleActionRequestDto extends Dto
{
    /**
     * Create a new create pre-sale action request DTO.
     *
     * @param  int  $threshold  The threshold value for triggering the action (required)
     * @param  string  $action_type  The type of action (required, e.g., "alert_mail")
     * @param  string  $target  The target for the action (required, e.g., email address)
     * @param  bool  $enabled  Whether the action is enabled (required)
     * @param  string  $pre_sale_uuid  The UUID of the associated pre-sale (required)
     */
    public function __construct(
        public int $threshold,
        public string $action_type,
        public string $target,
        public bool $enabled,
        public string $pre_sale_uuid
    ) {}
}
