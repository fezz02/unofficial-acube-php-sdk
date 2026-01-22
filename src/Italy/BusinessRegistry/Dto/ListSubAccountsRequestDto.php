<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for listing sub accounts of a business registry configuration.
 */
final readonly class ListSubAccountsRequestDto extends Dto
{
    public function __construct(
        public string $id,
    ) {}
}
