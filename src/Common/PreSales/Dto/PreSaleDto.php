<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\PreSales\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object representing a pre-sale.
 *
 * This DTO represents a pre-sale with information about credits,
 * invoices, and validity period.
 *
 * @see https://docs.acubeapi.com/documentation/common/pre-sales/
 */
final readonly class PreSaleDto extends Dto
{
    /**
     * Create a new pre-sale DTO.
     *
     * @param  string  $uuid  The unique identifier for the pre-sale
     * @param  string  $created_at  ISO 8601 timestamp when the pre-sale was created
     * @param  string  $valid_until  ISO 8601 timestamp until when the pre-sale is valid
     * @param  string  $total_credit_purchased  The total credit purchased (as string)
     * @param  string  $current_credit_available  The current credit available (as string)
     * @param  string  $current_credit_purchased  The current credit purchased (as string)
     * @param  int  $invoices_sent  The number of invoices sent
     * @param  int  $invoices_received  The number of invoices received
     */
    public function __construct(
        public string $uuid,
        public string $created_at,
        public string $valid_until,
        public string $total_credit_purchased,
        public string $current_credit_available,
        public string $current_credit_purchased,
        public int $invoices_sent,
        public int $invoices_received,
    ) {}
}
