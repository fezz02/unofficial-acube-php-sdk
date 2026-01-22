<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for deleting a business registry configuration.
 */
final readonly class DeleteBusinessRegistryConfigurationRequestDto extends Dto
{
    public function __construct(
        public string $id,
    ) {}
}
