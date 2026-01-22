<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for updating a simplified draft invoice.
 *
 * This DTO encapsulates the invoice ID and updated simplified invoice data.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final readonly class UpdateSimplifiedDraftInvoiceRequestDto extends Dto
{
    /**
     * Create a new update simplified draft invoice request DTO.
     *
     * @param  string  $id  The ID of the draft invoice to update
     * @param  FatturaElettronicaSemplificataDto|array<string, mixed>  $invoice  The updated simplified invoice data (DTO or array)
     */
    public function __construct(
        public string $id,
        public FatturaElettronicaSemplificataDto|array $invoice
    ) {}
}
