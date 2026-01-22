<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\InvoiceImport\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object representing the response from importing an invoice.
 *
 * This DTO contains the UUID and status of the imported invoice.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoice-imports/
 */
final readonly class InvoiceImportResponseDto extends Dto
{
    /**
     * Create a new invoice import response DTO.
     *
     * @param  string  $uuid  The unique identifier for the imported invoice
     * @param  string|null  $status  Optional status of the import
     */
    public function __construct(
        public string $uuid,
        public ?string $status = null
    ) {}
}
