<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for getting an invoice report.
 *
 * This DTO encapsulates query parameters for generating an invoice report.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final readonly class GetInvoiceReportRequestDto extends Dto
{
    /**
     * Create a new get invoice report request DTO.
     *
     * @param  array<string, mixed>  $query  Query parameters for the report
     */
    public function __construct(
        public array $query = []
    ) {}
}
