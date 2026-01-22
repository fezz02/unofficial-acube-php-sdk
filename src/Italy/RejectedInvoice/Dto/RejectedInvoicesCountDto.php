<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\RejectedInvoice\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object representing the count of recoverable rejected invoices.
 *
 * This DTO contains the count of invoices that can be recovered and the count
 * of invoices currently being processed for recovery.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/rejected-invoices/
 */
final readonly class RejectedInvoicesCountDto extends Dto
{
    /**
     * Create a new rejected invoices count DTO.
     *
     * @param  int  $count  The number of recoverable invoices
     * @param  int  $pending  The number of invoices being processed for recovery
     */
    public function __construct(
        public int $count,
        public int $pending
    ) {}
}
