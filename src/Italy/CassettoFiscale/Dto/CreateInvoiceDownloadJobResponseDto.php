<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\CassettoFiscale\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object representing the response from creating an invoice download job.
 *
 * This DTO contains the job UUID for the created download job.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/cassetto-fiscale/
 */
final readonly class CreateInvoiceDownloadJobResponseDto extends Dto
{
    /**
     * Create a new create invoice download job response DTO.
     *
     * @param  string  $uuid  The unique identifier for the download job
     */
    public function __construct(
        public string $uuid
    ) {}
}
