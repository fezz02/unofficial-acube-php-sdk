<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for creating a simplified draft invoice.
 *
 * This DTO encapsulates the simplified invoice data for creating a draft invoice.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final readonly class CreateSimplifiedDraftInvoiceRequestDto extends Dto
{
    /**
     * Create a new create simplified draft invoice request DTO.
     *
     * @param  FatturaElettronicaSemplificataDto|array<string, mixed>  $invoice  The simplified invoice data (DTO or array)
     */
    public function __construct(
        public FatturaElettronicaSemplificataDto|array $invoice
    ) {}
}
