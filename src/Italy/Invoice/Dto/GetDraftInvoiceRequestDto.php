<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for getting a single draft invoice by ID.
 *
 * This DTO encapsulates the ID path parameter for retrieving a specific draft invoice.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final readonly class GetDraftInvoiceRequestDto extends Dto
{
    /**
     * Create a new get draft invoice request DTO.
     *
     * @param  string  $id  The ID of the draft invoice to retrieve
     */
    public function __construct(
        public string $id
    ) {}
}
