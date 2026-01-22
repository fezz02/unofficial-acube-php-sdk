<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\NumberingSequence\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for creating a numbering sequence.
 *
 * This DTO contains the data required to create a new numbering sequence.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/numbering-sequences/
 */
final readonly class CreateNumberingSequenceRequestDto extends Dto
{
    /**
     * Create a new create numbering sequence request DTO.
     *
     * @param  string  $name  The unique identifier for the sequence (required)
     * @param  string  $format  The format template with placeholders (required)
     * @param  int  $number  The last number used (set 0 to start from 1) (required)
     */
    public function __construct(
        public string $name,
        public string $format,
        public int $number
    ) {}
}
