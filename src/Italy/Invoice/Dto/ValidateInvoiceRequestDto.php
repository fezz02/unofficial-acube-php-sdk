<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for validating an invoice.
 *
 * This DTO encapsulates the invoice data for validation without sending it to the SDI.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final readonly class ValidateInvoiceRequestDto extends Dto
{
    /**
     * Create a new validate invoice request DTO.
     *
     * @param  FatturaElettronicaDto|array<string, mixed>  $invoice  The invoice data (DTO or array)
     */
    public function __construct(
        public FatturaElettronicaDto|array $invoice
    ) {}
}
