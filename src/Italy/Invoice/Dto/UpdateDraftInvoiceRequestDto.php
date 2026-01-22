<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for updating a draft invoice.
 *
 * This DTO encapsulates the invoice ID and updated invoice data.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final readonly class UpdateDraftInvoiceRequestDto extends Dto
{
    /**
     * Create a new update draft invoice request DTO.
     *
     * @param  string  $id  The ID of the draft invoice to update
     * @param  FatturaElettronicaDto|array<string, mixed>  $invoice  The updated invoice data (DTO or array)
     */
    public function __construct(
        public string $id,
        public FatturaElettronicaDto|array $invoice
    ) {}
}
