<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\InvoiceTransfer\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for getting a single invoice transfer by ID.
 *
 * This DTO encapsulates the ID path parameter for retrieving a specific invoice transfer.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoice-transfers/
 */
final readonly class GetInvoiceTransferRequestDto extends Dto
{
    /**
     * Create a new get invoice transfer request DTO.
     *
     * @param  string  $id  The ID of the invoice transfer to retrieve
     */
    public function __construct(
        public string $id
    ) {}
}
