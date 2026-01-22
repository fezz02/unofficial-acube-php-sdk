<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\RejectedInvoice\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object representing the response from starting invoice recovery.
 *
 * This DTO contains the job UUID and the count of invoices being queued for recovery.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/rejected-invoices/
 */
final readonly class RecoverRejectedInvoicesResponseDto extends Dto
{
    /**
     * Create a new recover rejected invoices response DTO.
     *
     * @param  string  $uuid  The unique identifier for the recovery job
     * @param  int  $count  The number of invoices being queued for recovery
     */
    public function __construct(
        public string $uuid,
        public int $count
    ) {}
}
