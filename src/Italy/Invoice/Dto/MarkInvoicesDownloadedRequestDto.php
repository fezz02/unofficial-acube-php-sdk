<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for marking invoices as downloaded.
 *
 * This DTO encapsulates the invoice UUIDs to mark as downloaded.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final readonly class MarkInvoicesDownloadedRequestDto extends Dto
{
    /**
     * Create a new mark invoices downloaded request DTO.
     *
     * @param  array<string>  $uuids  Array of invoice UUIDs to mark as downloaded
     */
    public function __construct(
        public array $uuids
    ) {}
}
