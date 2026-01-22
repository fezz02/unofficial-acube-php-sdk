<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Receipt\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for listing receipts.
 *
 * This DTO encapsulates query parameters for filtering and paginating receipts.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/receipts/
 */
final readonly class GetReceiptsRequestDto extends Dto
{
    /**
     * Create a new get receipts request DTO.
     *
     * @param  array<string, mixed>  $query  Query parameters for filtering and pagination
     */
    public function __construct(
        public array $query = []
    ) {}
}
