<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\PreSaleActions\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for updating a pre-sale action.
 *
 * This DTO contains the data required to update an existing pre-sale action.
 * The UUID is passed separately as a path parameter.
 *
 * @see https://docs.acubeapi.com/documentation/common/pre-sale-actions/
 */
final readonly class UpdatePreSaleActionRequestDto extends Dto
{
    /**
     * Create a new update pre-sale action request DTO.
     *
     * @param  int  $threshold  The threshold value for triggering the action
     * @param  string  $action_type  The type of action (e.g., "alert_mail")
     * @param  string  $target  The target for the action (e.g., email address)
     * @param  bool  $enabled  Whether the action is enabled
     * @param  string  $pre_sale_uuid  The UUID of the associated pre-sale
     */
    public function __construct(
        public int $threshold,
        public string $action_type,
        public string $target,
        public bool $enabled,
        public string $pre_sale_uuid
    ) {}
}
