<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\InvoiceTransfer\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for downloading an invoice transfer.
 *
 * This DTO encapsulates the ID path parameter for downloading an invoice transfer file.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoice-transfers/
 */
final readonly class DownloadInvoiceTransferRequestDto extends Dto
{
    /**
     * Create a new download invoice transfer request DTO.
     *
     * @param  string  $id  The ID of the invoice transfer to download
     */
    public function __construct(
        public string $id
    ) {}
}
