<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\InvoiceTransfer\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object representing an invoice transfer.
 *
 * This DTO represents an invoice transfer resource.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoice-transfers/
 */
final readonly class InvoiceTransferDto extends Dto
{
    /**
     * Create a new invoice transfer DTO.
     *
     * @param  string|null  $uuid  The UUID of the invoice transfer
     * @param  string|null  $supplier_name  The supplier name
     * @param  string|null  $supplier_fiscal_id  The supplier fiscal ID
     * @param  string|null  $customer_name  The customer name
     * @param  string|null  $customer_fiscal_id  The customer fiscal ID
     * @param  string|null  $invoice_number  The invoice number
     * @param  string|null  $invoice_date  The invoice date
     * @param  string|null  $invoice_type  The invoice type
     * @param  float|null  $invoice_net_amount  The invoice net amount
     * @param  float|null  $invoice_vat_amount  The invoice VAT amount
     * @param  float|null  $invoice_tot_amount  The invoice total amount
     * @param  string|null  $original_file_name  The original file name
     * @param  string|null  $reference  The reference
     * @param  string|null  $created_at  The creation timestamp
     * @param  string|null  $violations  The violations
     * @param  string|null  $sent_at  The sent timestamp
     * @param  string|null  $sdi_id  The SDI ID
     * @param  string|null  $sdi_file_name  The SDI file name
     * @param  string|null  $invoice_uuid  The invoice UUID
     * @param  string|null  $marking  The marking
     * @param  string|null  $notice  The notice
     */
    public function __construct(
        public ?string $uuid = null,
        public ?string $supplier_name = null,
        public ?string $supplier_fiscal_id = null,
        public ?string $customer_name = null,
        public ?string $customer_fiscal_id = null,
        public ?string $invoice_number = null,
        public ?string $invoice_date = null,
        public ?string $invoice_type = null,
        public ?float $invoice_net_amount = null,
        public ?float $invoice_vat_amount = null,
        public ?float $invoice_tot_amount = null,
        public ?string $original_file_name = null,
        public ?string $reference = null,
        public ?string $created_at = null,
        public ?string $violations = null,
        public ?string $sent_at = null,
        public ?string $sdi_id = null,
        public ?string $sdi_file_name = null,
        public ?string $invoice_uuid = null,
        public ?string $marking = null,
        public ?string $notice = null
    ) {}
}
