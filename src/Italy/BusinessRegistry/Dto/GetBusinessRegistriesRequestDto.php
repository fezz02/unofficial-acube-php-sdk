<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for listing Business Registry entries.
 *
 * This DTO contains optional query parameters for filtering and paginating business registry entries.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry/
 */
final readonly class GetBusinessRegistriesRequestDto extends Dto
{
    /**
     * Create a new get business registries request DTO.
     *
     * @param  string|null  $simpleSearch  Search by multiple fields at once: businessName, name, surname, businessVatNumberCode, businessFiscalCode
     * @param  int|null  $page  The collection page number
     */
    public function __construct(
        public ?string $simpleSearch = null,
        public ?int $page = null,
    ) {}
}
