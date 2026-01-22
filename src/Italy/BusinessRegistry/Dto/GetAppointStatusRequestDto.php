<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for getting the status of an appointing request.
 */
final readonly class GetAppointStatusRequestDto extends Dto
{
    public function __construct(
        public string $id,
    ) {}
}
