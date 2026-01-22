<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\InvoiceImport\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for importing a supplier invoice.
 *
 * This DTO contains the base64-encoded invoice XML and optional metadata file.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoice-imports/
 */
final readonly class SupplierInvoiceImportRequestDto extends Dto
{
    /**
     * Create a new supplier invoice import request DTO.
     *
     * @param  string  $invoice  Base64-encoded invoice XML (required)
     * @param  string|null  $metadata  Optional base64-encoded metadata file
     */
    public function __construct(
        public string $invoice,
        public ?string $metadata = null
    ) {}
}
