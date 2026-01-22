<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\NumberingSequence\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for retrieving a numbering sequence by ID.
 */
final readonly class GetNumberingSequenceRequestDto extends Dto
{
    public function __construct(
        public string $id,
    ) {}
}
