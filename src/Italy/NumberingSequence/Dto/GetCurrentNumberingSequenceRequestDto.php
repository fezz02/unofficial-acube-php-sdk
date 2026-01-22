<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\NumberingSequence\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for retrieving the current numbering sequence by name.
 */
final readonly class GetCurrentNumberingSequenceRequestDto extends Dto
{
    public function __construct(
        public string $name,
    ) {}
}
