<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object representing the body of a FatturaPA invoice.
 *
 * This DTO represents a single body section of a FatturaPA invoice in JSON format,
 * containing general document data and goods/services data.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final readonly class FatturaElettronicaBodyDto extends Dto
{
    /**
     * Create a new FatturaPA body DTO.
     *
     * @param  array<string, mixed>  $dati_generali  General document data
     * @param  array<int, array<string, mixed>>  $dati_beni_servizi  Goods/services data
     */
    public function __construct(
        public array $dati_generali,
        public array $dati_beni_servizi
    ) {}
}
