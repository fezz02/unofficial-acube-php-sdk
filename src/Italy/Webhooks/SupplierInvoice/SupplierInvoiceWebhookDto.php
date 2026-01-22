<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Webhooks\SupplierInvoice;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object representing a supplier invoice webhook payload.
 *
 * This DTO represents the complete webhook payload received when a supplier invoice
 * event is triggered. It contains the invoice data with metadata and payload.
 */
final readonly class SupplierInvoiceWebhookDto extends Dto
{
    /**
     * Create a new supplier invoice webhook DTO.
     *
     * @param  SupplierInvoiceDto  $invoice  The invoice data
     */
    public function __construct(
        public SupplierInvoiceDto $invoice,
    ) {}

    /**
     * Create a supplier invoice webhook DTO from an array.
     *
     * @param  array<string, mixed>  $data  The webhook payload data
     */
    public static function from(array $data): static
    {
        // If the data has an 'invoice' key, use that
        $invoiceData = null;
        if (isset($data['invoice']) && is_array($data['invoice'])) {
            /** @var array<string, mixed> $invoiceData */
            $invoiceData = $data['invoice'];
        } else {
            // Otherwise, assume the data itself is the invoice
            /** @var array<string, mixed> $invoiceData */
            $invoiceData = $data;
        }

        $invoice = SupplierInvoiceDto::from($invoiceData);

        return new self(
            invoice: $invoice,
        );
    }
}
