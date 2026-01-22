<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for creating a Business Registry Configuration.
 *
 * This DTO contains the required and optional fields for creating a new business registry configuration.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry-configuration/
 */
final readonly class CreateBusinessRegistryConfigurationRequestDto extends Dto
{
    /**
     * Create a new create business registry configuration request DTO.
     *
     * @param  string  $fiscal_id  The fiscal code or the vat number WITHOUT the country prefix (required)
     * @param  string|null  $name  The owner's name for the fiscal id
     * @param  string|null  $email  The email where the owner of the fiscalId will receive communications
     * @param  bool|null  $supplier_invoice_enabled  The fiscal id is enabled to receive supplier invoices
     * @param  bool|null  $receipts_enabled  Enable receipt service
     * @param  bool|null  $apply_signature  Apply digital signature before sending invoices to SDI
     * @param  bool|null  $apply_legal_storage  Apply the legal storage for invoices sent/received by the fiscal id
     * @param  array<int, array<string, mixed>>  $api_configurations  The API configurations (webhooks). Defaults to empty array.
     */
    public function __construct(
        public string $fiscal_id,
        public ?string $name = null,
        public ?string $email = null,
        public ?bool $supplier_invoice_enabled = null,
        public ?bool $receipts_enabled = null,
        public ?bool $apply_signature = null,
        public ?bool $apply_legal_storage = null,
        public array $api_configurations = [],
    ) {}
}
