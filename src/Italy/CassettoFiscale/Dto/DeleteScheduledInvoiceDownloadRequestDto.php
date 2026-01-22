<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\CassettoFiscale\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for deleting a scheduled invoice download.
 *
 * This DTO contains the fiscal ID required to delete a schedule.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/cassetto-fiscale/
 */
final readonly class DeleteScheduledInvoiceDownloadRequestDto extends Dto
{
    /**
     * Create a new delete scheduled invoice download request DTO.
     *
     * @param  string  $fiscal_id  The fiscal ID
     */
    public function __construct(
        public string $fiscal_id
    ) {}
}
