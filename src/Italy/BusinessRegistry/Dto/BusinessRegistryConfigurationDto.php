<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object representing a Business Registry Configuration.
 *
 * This DTO represents a business registry configuration with all its properties.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry-configuration/
 */
final readonly class BusinessRegistryConfigurationDto extends Dto
{
    /**
     * Create a new business registry configuration DTO.
     *
     * @param  string  $fiscal_id  The fiscal code or the vat number WITHOUT the country prefix
     * @param  string|null  $name  The owner's name for the fiscal id
     * @param  string|null  $email  The email where the owner of the fiscalId will receive communications
     * @param  string|null  $email_for_preservation_requested_at  The legal storage service requested an email address to activate the account
     * @param  bool|null  $supplier_invoice_enabled  The fiscal id is enabled to receive supplier invoices
     * @param  bool|null  $receipts_enabled  Enable receipt service
     * @param  bool|null  $apply_signature  Apply digital signature before sending invoices to SDI
     * @param  bool|null  $apply_legal_storage  Apply the legal storage for invoices sent/received by the fiscal id
     * @param  bool|null  $legal_storage_active  This is set asynchronously when the email owner has activated the account
     * @param  array<int, array<string, mixed>>|null  $api_configurations  The API configurations
     */
    public function __construct(
        public string $fiscal_id,
        public ?string $name = null,
        public ?string $email = null,
        public ?string $email_for_preservation_requested_at = null,
        public ?bool $supplier_invoice_enabled = null,
        public ?bool $receipts_enabled = null,
        public ?bool $apply_signature = null,
        public ?bool $apply_legal_storage = null,
        public ?bool $legal_storage_active = null,
        public ?array $api_configurations = null,
    ) {}
}
