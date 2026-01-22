<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for archiving a rejected invoice.
 *
 * This DTO encapsulates the ID path parameter for archiving a rejected invoice.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final readonly class ArchiveRejectedInvoiceRequestDto extends Dto
{
    /**
     * Create a new archive rejected invoice request DTO.
     *
     * @param  string  $id  The ID of the rejected invoice to archive
     */
    public function __construct(
        public string $id
    ) {}
}
