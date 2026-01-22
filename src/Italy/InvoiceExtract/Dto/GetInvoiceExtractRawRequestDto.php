<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\InvoiceExtract\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for getting raw invoice extract data.
 *
 * This DTO encapsulates the UUID path parameter for retrieving raw extracted information.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoice-extract/
 */
final readonly class GetInvoiceExtractRawRequestDto extends Dto
{
    /**
     * Create a new get invoice extract raw request DTO.
     *
     * @param  string  $uuid  The UUID of the invoice extract job
     */
    public function __construct(
        public string $uuid
    ) {}
}
