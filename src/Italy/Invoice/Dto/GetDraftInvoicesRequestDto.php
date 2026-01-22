<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for listing draft invoices.
 *
 * This DTO encapsulates query parameters for filtering and paginating draft invoices.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final readonly class GetDraftInvoicesRequestDto extends Dto
{
    /**
     * Create a new get draft invoices request DTO.
     *
     * @param  array<string, mixed>  $query  Query parameters for filtering and pagination
     */
    public function __construct(
        public array $query = []
    ) {}
}
