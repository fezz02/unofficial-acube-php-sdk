<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\InvoiceExtract\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for creating an invoice extract job.
 *
 * This DTO contains the file path and optional conversion configuration for the PDF extraction process.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoice-extract/
 */
final readonly class CreateInvoiceExtractJobRequestDto extends Dto
{
    /**
     * Create a new create invoice extract job request DTO.
     *
     * @param  string  $file_path  Path to the PDF file to upload
     * @param  float|null  $default_vat_rate  Default VAT rate to use if not detected (0 if none)
     * @param  bool|null  $convert_amounts  Whether to convert amounts to EUR (false to keep original currency)
     */
    public function __construct(
        public string $file_path,
        public ?float $default_vat_rate = null,
        public ?bool $convert_amounts = null
    ) {}
}
