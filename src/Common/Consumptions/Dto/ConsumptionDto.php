<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\Consumptions\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object representing a consumption.
 *
 * This DTO represents consumption data for a specific month and year,
 * including invoice counts and totals.
 *
 * @see https://docs.acubeapi.com/documentation/common/consumptions/
 */
final readonly class ConsumptionDto extends Dto
{
    /**
     * Create a new consumption DTO.
     *
     * @param  string  $uuid  The unique identifier for the consumption
     * @param  int  $month  The month (1-12)
     * @param  int  $year  The year
     * @param  string  $total  The total consumption amount as a string
     * @param  int  $invoices_sent  The number of invoices sent
     * @param  int  $invoices_received  The number of invoices received
     */
    public function __construct(
        public string $uuid,
        public int $month,
        public int $year,
        public string $total,
        public int $invoices_sent,
        public int $invoices_received,
    ) {}
}
