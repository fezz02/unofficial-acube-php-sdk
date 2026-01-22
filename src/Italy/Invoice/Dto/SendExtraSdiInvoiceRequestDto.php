<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for sending an extra SDI invoice.
 *
 * This DTO encapsulates the invoice data for creating an extra SDI invoice.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final readonly class SendExtraSdiInvoiceRequestDto extends Dto
{
    /**
     * Create a new send extra SDI invoice request DTO.
     *
     * @param  array<string, mixed>  $invoice  The extra SDI invoice data
     */
    public function __construct(
        public array $invoice
    ) {}
}
