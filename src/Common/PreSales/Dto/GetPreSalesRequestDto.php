<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\PreSales\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for getting a list of pre-sales.
 *
 * This DTO contains optional query parameters for filtering and pagination.
 *
 * @see https://docs.acubeapi.com/documentation/common/pre-sales/
 */
final readonly class GetPreSalesRequestDto extends Dto
{
    /**
     * Create a new get pre-sales request DTO.
     *
     * @param  array<string, mixed>  $query  Optional query parameters (page, etc.)
     */
    public function __construct(
        public array $query = []
    ) {}
}
