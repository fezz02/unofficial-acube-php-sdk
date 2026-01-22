<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for sending a draft invoice.
 *
 * This DTO encapsulates the ID path parameter for sending a draft invoice to the SDI.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final readonly class SendDraftInvoiceRequestDto extends Dto
{
    /**
     * Create a new send draft invoice request DTO.
     *
     * @param  string  $id  The ID of the draft invoice to send
     */
    public function __construct(
        public string $id
    ) {}
}
