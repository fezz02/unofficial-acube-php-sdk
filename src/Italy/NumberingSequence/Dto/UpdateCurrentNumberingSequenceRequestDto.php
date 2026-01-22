<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\NumberingSequence\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for updating the current numbering sequence by name.
 *
 * This DTO encapsulates the name and updated sequence data.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/numbering-sequences/
 */
final readonly class UpdateCurrentNumberingSequenceRequestDto extends Dto
{
    /**
     * Create a new update current numbering sequence request DTO.
     *
     * @param  string  $name  The name of the numbering sequence
     * @param  array<string, mixed>  $sequence  The updated sequence data
     */
    public function __construct(
        public string $name,
        public array $sequence
    ) {}
}
