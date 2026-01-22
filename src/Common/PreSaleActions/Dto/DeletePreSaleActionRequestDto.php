<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\PreSaleActions\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for deleting a pre-sale action.
 *
 * This DTO contains the UUID required to delete a pre-sale action.
 *
 * @see https://docs.acubeapi.com/documentation/common/pre-sale-actions/
 */
final readonly class DeletePreSaleActionRequestDto extends Dto
{
    /**
     * Create a new delete pre-sale action request DTO.
     *
     * @param  string  $uuid  The pre-sale action UUID
     */
    public function __construct(
        public string $uuid
    ) {}
}
