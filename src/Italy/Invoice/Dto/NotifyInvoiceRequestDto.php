<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for notifying an invoice webhook.
 *
 * This DTO encapsulates the ID path parameter for triggering a webhook notification for an invoice.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final readonly class NotifyInvoiceRequestDto extends Dto
{
    /**
     * Create a new notify invoice request DTO.
     *
     * @param  string  $id  The ID of the invoice to notify
     */
    public function __construct(
        public string $id
    ) {}
}
