<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for validating a simplified invoice.
 *
 * This DTO encapsulates the simplified invoice data for validation without sending it to the SDI.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final readonly class ValidateSimplifiedInvoiceRequestDto extends Dto
{
    /**
     * Create a new validate simplified invoice request DTO.
     *
     * @param  FatturaElettronicaSemplificataDto|array<string, mixed>  $invoice  The simplified invoice data (DTO or array)
     */
    public function __construct(
        public FatturaElettronicaSemplificataDto|array $invoice
    ) {}
}
