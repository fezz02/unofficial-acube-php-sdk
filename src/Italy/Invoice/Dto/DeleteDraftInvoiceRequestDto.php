<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for deleting a draft invoice.
 *
 * This DTO encapsulates the ID path parameter for deleting a specific draft invoice.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final readonly class DeleteDraftInvoiceRequestDto extends Dto
{
    /**
     * Create a new delete draft invoice request DTO.
     *
     * @param  string  $id  The ID of the draft invoice to delete
     */
    public function __construct(
        public string $id
    ) {}
}
