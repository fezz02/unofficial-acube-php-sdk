<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\PreSaleActions\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for getting a list of pre-sale actions.
 *
 * This DTO contains optional query parameters for filtering and pagination.
 *
 * @see https://docs.acubeapi.com/documentation/common/pre-sale-actions/
 */
final readonly class GetPreSaleActionsRequestDto extends Dto
{
    /**
     * Create a new get pre-sale actions request DTO.
     *
     * @param  array<string, mixed>  $query  Optional query parameters (page, etc.)
     */
    public function __construct(
        public array $query = []
    ) {}
}
