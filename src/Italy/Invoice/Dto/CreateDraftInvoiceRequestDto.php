<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for creating a draft invoice.
 *
 * This DTO encapsulates the invoice data for creating a draft invoice.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final readonly class CreateDraftInvoiceRequestDto extends Dto
{
    /**
     * Create a new create draft invoice request DTO.
     *
     * @param  FatturaElettronicaDto|array<string, mixed>  $invoice  The invoice data (DTO or array)
     */
    public function __construct(
        public FatturaElettronicaDto|array $invoice
    ) {}
}
