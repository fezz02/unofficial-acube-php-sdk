<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\Consumptions\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for listing consumptions.
 *
 * This DTO encapsulates query parameters for filtering and paginating consumptions.
 *
 * @see https://docs.acubeapi.com/documentation/common/consumptions/
 */
final readonly class GetConsumptionsRequestDto extends Dto
{
    /**
     * Create a new get consumptions request DTO.
     *
     * @param  array<string, mixed>  $query  Query parameters including page, year, year[], month, month[]
     */
    public function __construct(
        public array $query = []
    ) {}
}
