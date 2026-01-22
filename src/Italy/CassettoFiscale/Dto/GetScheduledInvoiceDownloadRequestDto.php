<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\CassettoFiscale\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for getting scheduled invoice download information.
 *
 * This DTO contains the fiscal ID required to retrieve schedule information.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/cassetto-fiscale/
 */
final readonly class GetScheduledInvoiceDownloadRequestDto extends Dto
{
    /**
     * Create a new get scheduled invoice download request DTO.
     *
     * @param  string  $fiscal_id  The fiscal ID
     */
    public function __construct(
        public string $fiscal_id
    ) {}
}
