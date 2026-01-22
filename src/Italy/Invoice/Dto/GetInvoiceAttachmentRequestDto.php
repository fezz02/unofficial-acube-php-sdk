<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for getting an invoice attachment.
 *
 * This DTO encapsulates the UUID and index path parameters for retrieving an invoice attachment.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final readonly class GetInvoiceAttachmentRequestDto extends Dto
{
    /**
     * Create a new get invoice attachment request DTO.
     *
     * @param  string  $uuid  The UUID of the invoice
     * @param  int  $index  The attachment index (0-based)
     */
    public function __construct(
        public string $uuid,
        public int $index
    ) {}
}
