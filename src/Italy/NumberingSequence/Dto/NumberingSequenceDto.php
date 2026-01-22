<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\NumberingSequence\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object representing a numbering sequence.
 *
 * This DTO represents a numbering sequence used for automatic invoice numbering.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/numbering-sequences/
 */
final readonly class NumberingSequenceDto extends Dto
{
    /**
     * Create a new numbering sequence DTO.
     *
     * @param  string  $name  The unique identifier for the sequence
     * @param  string  $format  The format template with placeholders (%s, %0Xs, %Y, %y)
     * @param  int  $number  The last number used in the sequence
     * @param  string|null  $uuid  The UUID of the numbering sequence
     * @param  int|null  $year  The year for the sequence
     * @param  string|null  $last_date  The last date the sequence was used
     * @param  string|null  $created_at  The creation timestamp
     * @param  string|null  $updated_at  The last update timestamp
     */
    public function __construct(
        public string $name,
        public string $format,
        public int $number,
        public ?string $uuid = null,
        public ?int $year = null,
        public ?string $last_date = null,
        public ?string $created_at = null,
        public ?string $updated_at = null
    ) {}
}
