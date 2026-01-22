<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\RejectedInvoice\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for requesting recovery of rejected invoices.
 *
 * This DTO contains the date range for recovering rejected invoices.
 * The fiscal ID is passed separately as a path parameter.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/rejected-invoices/
 */
final readonly class RecoverRejectedInvoicesRequestDto extends Dto
{
    /**
     * Create a new recover rejected invoices request DTO.
     *
     * @param  string  $from_date  Start date in YYYY-MM-DD format
     * @param  string  $to_date  End date in YYYY-MM-DD format
     */
    public function __construct(
        public string $from_date,
        public string $to_date
    ) {}
}
