<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object representing a simplified FatturaPA invoice in JSON format.
 *
 * Simplified invoices are used for invoices with a total amount ≤ 400€.
 * This DTO represents the simplified invoice structure.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final readonly class FatturaElettronicaSemplificataDto extends Dto
{
    /**
     * Create a new simplified FatturaPA invoice DTO.
     *
     * @param  array<string, mixed>  $fattura_elettronica_header  The invoice header
     * @param  array<int, array<string, mixed>>  $fattura_elettronica_body  Array of invoice body sections
     */
    public function __construct(
        public array $fattura_elettronica_header,
        public array $fattura_elettronica_body
    ) {}
}
