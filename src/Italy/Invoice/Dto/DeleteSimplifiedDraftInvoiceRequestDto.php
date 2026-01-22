<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for deleting a simplified draft invoice.
 *
 * This DTO encapsulates the ID path parameter for deleting a specific simplified draft invoice.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final readonly class DeleteSimplifiedDraftInvoiceRequestDto extends Dto
{
    /**
     * Create a new delete simplified draft invoice request DTO.
     *
     * @param  string  $id  The ID of the draft invoice to delete
     */
    public function __construct(
        public string $id
    ) {}
}
