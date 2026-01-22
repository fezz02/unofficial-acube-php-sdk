<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for listing Business Registry Configurations.
 *
 * This DTO contains optional query parameters for filtering and paginating business registry configurations.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry-configuration/
 */
final readonly class GetBusinessRegistryConfigurationsRequestDto extends Dto
{
    /**
     * Create a new get business registry configurations request DTO.
     *
     * @param  string|null  $fiscal_id  Filter by fiscal ID
     * @param  array<int, string>|null  $fiscal_id_array  Filter by multiple fiscal IDs
     * @param  string|null  $email  Filter by email
     * @param  string|null  $name  Filter by name
     * @param  bool|null  $supplier_invoice_enabled  Filter by supplier invoice enabled
     * @param  bool|null  $apply_signature  Filter by apply signature
     * @param  bool|null  $apply_legal_storage  Filter by apply legal storage
     * @param  bool|null  $legal_storage_active  Filter by legal storage active
     * @param  bool|null  $receipts_enabled  Filter by receipts enabled
     * @param  int|null  $page  The collection page number
     */
    public function __construct(
        public ?string $fiscal_id = null,
        public ?array $fiscal_id_array = null,
        public ?string $email = null,
        public ?string $name = null,
        public ?bool $supplier_invoice_enabled = null,
        public ?bool $apply_signature = null,
        public ?bool $apply_legal_storage = null,
        public ?bool $legal_storage_active = null,
        public ?bool $receipts_enabled = null,
        public ?int $page = null,
    ) {}
}
