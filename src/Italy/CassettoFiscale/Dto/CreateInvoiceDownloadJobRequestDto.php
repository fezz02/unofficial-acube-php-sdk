<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\CassettoFiscale\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for creating a one-shot invoice download job.
 *
 * This DTO contains the date range and fiscal ID for downloading invoices.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/cassetto-fiscale/
 */
final readonly class CreateInvoiceDownloadJobRequestDto extends Dto
{
    /**
     * Create a new create invoice download job request DTO.
     *
     * @param  string  $from_date  Start date in YYYY-MM-DD format (required)
     * @param  string  $to_date  End date in YYYY-MM-DD format (required)
     * @param  string  $fiscal_id  The fiscal ID (required)
     */
    public function __construct(
        public string $from_date,
        public string $to_date,
        public string $fiscal_id
    ) {}
}
