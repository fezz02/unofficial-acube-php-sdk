<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for retrieving a Business Registry entry by ID.
 */
final readonly class GetBusinessRegistryRequestDto extends Dto
{
    public function __construct(
        public string $id,
    ) {}
}
