<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\CassettoFiscale\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for scheduling invoice downloads.
 *
 * This DTO contains the configuration for scheduling daily invoice downloads.
 * The fiscal ID is passed separately as a path parameter.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/cassetto-fiscale/
 */
final readonly class ScheduleInvoiceDownloadRequestDto extends Dto
{
    /**
     * Create a new schedule invoice download request DTO.
     *
     * @param  bool  $download_archive  Whether to download the full archive (true) or just last 3 days (false)
     */
    public function __construct(
        public bool $download_archive
    ) {}
}
