<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\ApiConfiguration\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for listing API configurations.
 *
 * Contains optional query parameters for filtering and paginating API configurations.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/
 */
final readonly class GetApiConfigurationsRequestDto extends Dto
{
    /**
     * Create a new get API configurations request DTO.
     *
     * @param  string|null  $business_registry_configurations_fiscal_id  Filter by single fiscal ID
     * @param  array<int, string>|null  $business_registry_configurations_fiscal_id_array  Filter by multiple fiscal IDs
     * @param  string|null  $target_url  Filter by target URL
     * @param  int|null  $page  The page number
     * @param  int|null  $itemsPerPage  The number of items per page
     */
    public function __construct(
        public ?string $business_registry_configurations_fiscal_id = null,
        public ?array $business_registry_configurations_fiscal_id_array = null,
        public ?string $target_url = null,
        public ?int $page = null,
        public ?int $itemsPerPage = null,
    ) {}
}
