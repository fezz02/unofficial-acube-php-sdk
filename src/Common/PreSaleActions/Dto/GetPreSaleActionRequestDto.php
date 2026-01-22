<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\PreSaleActions\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for getting a pre-sale action.
 *
 * This DTO contains the UUID required to retrieve a pre-sale action.
 *
 * @see https://docs.acubeapi.com/documentation/common/pre-sale-actions/
 */
final readonly class GetPreSaleActionRequestDto extends Dto
{
    /**
     * Create a new get pre-sale action request DTO.
     *
     * @param  string  $uuid  The pre-sale action UUID
     */
    public function __construct(
        public string $uuid
    ) {}
}
