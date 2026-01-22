<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\InvoiceExtract\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for getting an invoice extract job.
 *
 * This DTO contains the UUID required to retrieve an invoice extract job.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoice-extract/
 */
final readonly class GetInvoiceExtractJobRequestDto extends Dto
{
    /**
     * Create a new get invoice extract job request DTO.
     *
     * @param  string  $uuid  The job UUID
     */
    public function __construct(
        public string $uuid
    ) {}
}
