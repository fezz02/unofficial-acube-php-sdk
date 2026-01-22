<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\CassettoFiscale\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for updating scheduled invoice download auto-renewal.
 *
 * This DTO contains the auto-renewal configuration for scheduled downloads.
 * The fiscal ID is passed separately as a path parameter.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/cassetto-fiscale/
 */
final readonly class UpdateScheduledInvoiceDownloadRequestDto extends Dto
{
    /**
     * Create a new update scheduled invoice download request DTO.
     *
     * @param  bool  $auto_renew  Whether the schedule should auto-renew
     */
    public function __construct(
        public bool $auto_renew
    ) {}
}
