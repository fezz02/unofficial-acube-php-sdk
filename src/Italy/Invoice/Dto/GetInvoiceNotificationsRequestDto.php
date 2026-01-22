<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for getting invoice notifications.
 *
 * This DTO encapsulates the UUID path parameter for retrieving notifications for an invoice.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final readonly class GetInvoiceNotificationsRequestDto extends Dto
{
    /**
     * Create a new get invoice notifications request DTO.
     *
     * @param  string  $uuid  The UUID of the invoice
     */
    public function __construct(
        public string $uuid
    ) {}
}
