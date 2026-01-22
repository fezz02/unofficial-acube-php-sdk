<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\InvoiceExtract\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for getting an invoice extract result.
 *
 * This DTO contains the UUID and format required to retrieve an invoice extract result.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoice-extract/
 */
final readonly class GetInvoiceExtractResultRequestDto extends Dto
{
    /**
     * Create a new get invoice extract result request DTO.
     *
     * @param  string  $uuid  The job UUID
     * @param  string  $format  The desired format: 'xml' or 'json' (default: 'json')
     */
    public function __construct(
        public string $uuid,
        public string $format = 'json'
    ) {}
}
