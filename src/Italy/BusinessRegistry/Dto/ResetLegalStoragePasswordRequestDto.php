<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for resetting the legal storage portal password.
 */
final readonly class ResetLegalStoragePasswordRequestDto extends Dto
{
    public function __construct(
        public string $id,
    ) {}
}
