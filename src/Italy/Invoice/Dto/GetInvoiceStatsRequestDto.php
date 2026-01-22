<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for getting invoice statistics.
 *
 * This DTO encapsulates the year path parameter and optional fiscal_id query parameter.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final readonly class GetInvoiceStatsRequestDto extends Dto
{
    /**
     * Create a new get invoice stats request DTO.
     *
     * @param  string  $year  The year for which to get statistics
     * @param  string|null  $fiscal_id  Optional fiscal identifier to filter statistics
     */
    public function __construct(
        public string $year,
        public ?string $fiscal_id = null,
    ) {}
}
