<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for getting a list of invoices.
 *
 * This DTO contains optional query parameters for filtering and pagination.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final readonly class GetInvoicesRequestDto extends Dto
{
    /**
     * Create a new get invoices request DTO.
     *
     * @param  array<string, mixed>  $query  Optional query parameters (page, filters, etc.)
     */
    public function __construct(
        public array $query = []
    ) {}
}
