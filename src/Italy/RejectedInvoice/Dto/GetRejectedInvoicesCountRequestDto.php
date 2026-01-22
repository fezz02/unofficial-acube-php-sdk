<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\RejectedInvoice\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for getting the count of recoverable rejected invoices.
 *
 * This DTO contains the fiscal ID and optional query parameters for filtering by date range.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/rejected-invoices/
 */
final readonly class GetRejectedInvoicesCountRequestDto extends Dto
{
    /**
     * Create a new get rejected invoices count request DTO.
     *
     * @param  string  $fiscal_id  The fiscal ID
     * @param  string|null  $from_date  Optional start date in YYYY-MM-DD format
     * @param  string|null  $to_date  Optional end date in YYYY-MM-DD format
     */
    public function __construct(
        public string $fiscal_id,
        public ?string $from_date = null,
        public ?string $to_date = null
    ) {}
}
