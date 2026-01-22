<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for preserving an invoice.
 *
 * This DTO encapsulates the UUID path parameter for preserving an invoice to legal storage.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final readonly class PreserveInvoiceRequestDto extends Dto
{
    /**
     * Create a new preserve invoice request DTO.
     *
     * @param  string  $uuid  The UUID of the invoice to preserve
     */
    public function __construct(
        public string $uuid
    ) {}
}
