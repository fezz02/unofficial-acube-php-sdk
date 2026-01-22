<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\InvoiceTransfer\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for listing invoice transfers.
 *
 * This DTO encapsulates query parameters for filtering and paginating invoice transfers.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoice-transfers/
 */
final readonly class GetInvoiceTransfersRequestDto extends Dto
{
    /**
     * Create a new get invoice transfers request DTO.
     *
     * @param  array<string, mixed>  $query  Query parameters for filtering and pagination
     */
    public function __construct(
        public array $query = []
    ) {}
}
