<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object representing the header of a FatturaPA invoice.
 *
 * This DTO represents the header section of a FatturaPA invoice in JSON format,
 * containing transmission data, seller/provider information, and customer information.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final readonly class FatturaElettronicaHeaderDto extends Dto
{
    /**
     * Create a new FatturaPA header DTO.
     *
     * @param  array<string, mixed>  $dati_trasmissione  Transmission data
     * @param  array<string, mixed>  $cedente_prestatore  Seller/provider information
     * @param  array<string, mixed>  $cessionario_committente  Customer information
     */
    public function __construct(
        public array $dati_trasmissione,
        public array $cedente_prestatore,
        public array $cessionario_committente
    ) {}
}
