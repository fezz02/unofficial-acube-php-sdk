<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object representing the response from sending an invoice.
 *
 * This DTO contains the UUID of the invoice that was successfully submitted
 * for processing. The invoice is processed asynchronously.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final readonly class SendInvoiceResponseDto extends Dto
{
    /**
     * Create a new send invoice response DTO.
     *
     * @param  string  $uuid  The unique identifier for the submitted invoice
     */
    public function __construct(
        public string $uuid
    ) {}
}
