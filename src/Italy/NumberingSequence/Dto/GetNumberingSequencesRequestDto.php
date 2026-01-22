<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\NumberingSequence\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for listing numbering sequences.
 *
 * This DTO encapsulates query parameters for filtering and paginating numbering sequences.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/numbering-sequences/
 */
final readonly class GetNumberingSequencesRequestDto extends Dto
{
    /**
     * Create a new get numbering sequences request DTO.
     *
     * @param  array<string, mixed>  $query  Query parameters including sequenceName, year, page
     */
    public function __construct(
        public array $query = []
    ) {}
}
