<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for getting an invoice preserved document.
 *
 * This DTO encapsulates the ID path parameter for retrieving the preserved document for an invoice.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final readonly class GetInvoicePreservedDocumentRequestDto extends Dto
{
    /**
     * Create a new get invoice preserved document request DTO.
     *
     * @param  string  $id  The ID of the invoice
     */
    public function __construct(
        public string $id
    ) {}
}
