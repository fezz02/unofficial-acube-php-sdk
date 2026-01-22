<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\NumberingSequence\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for updating a numbering sequence.
 *
 * This DTO encapsulates the ID and updated sequence data.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/numbering-sequences/
 */
final readonly class UpdateNumberingSequenceRequestDto extends Dto
{
    /**
     * Create a new update numbering sequence request DTO.
     *
     * @param  string  $id  The ID of the numbering sequence to update
     * @param  array<string, mixed>  $sequence  The updated sequence data
     */
    public function __construct(
        public string $id,
        public array $sequence
    ) {}
}
