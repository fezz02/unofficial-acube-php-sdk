<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object representing a complete FatturaPA invoice in JSON format.
 *
 * This DTO represents a standard FatturaPA invoice with header and body sections.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final readonly class FatturaElettronicaDto extends Dto
{
    /**
     * Create a new FatturaPA invoice DTO.
     *
     * @param  FatturaElettronicaHeaderDto  $fattura_elettronica_header  The invoice header
     * @param  array<FatturaElettronicaBodyDto>  $fattura_elettronica_body  Array of invoice body sections
     */
    public function __construct(
        public FatturaElettronicaHeaderDto $fattura_elettronica_header,
        public array $fattura_elettronica_body
    ) {}
}
