<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for converting an invoice between formats.
 *
 * This DTO encapsulates the invoice data for conversion between JSON and XML formats.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final readonly class ConvertInvoiceRequestDto extends Dto
{
    /**
     * Create a new convert invoice request DTO.
     *
     * @param  string|array<string, mixed>  $invoice  The invoice data (JSON string or array for JSON->XML, XML string for XML->JSON)
     */
    public function __construct(
        public string|array $invoice
    ) {}
}
