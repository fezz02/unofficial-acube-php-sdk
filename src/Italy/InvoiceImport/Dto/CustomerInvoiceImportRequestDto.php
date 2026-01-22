<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\InvoiceImport\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for importing a customer invoice.
 *
 * This DTO contains the base64-encoded invoice XML and optional notification files.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoice-imports/
 */
final readonly class CustomerInvoiceImportRequestDto extends Dto
{
    /**
     * Create a new customer invoice import request DTO.
     *
     * @param  string  $invoice  Base64-encoded invoice XML (required)
     * @param  array<string, string>|null  $notifications  Optional notifications (RC, MC, NE) as base64-encoded XML
     */
    public function __construct(
        public string $invoice,
        public ?array $notifications = null
    ) {}
}
