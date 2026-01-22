<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for getting receipt settings.
 *
 * This DTO encapsulates the fiscal identifier used to retrieve receipt settings.
 */
final readonly class GetReceiptSettingsRequestDto extends Dto
{
    /**
     * Create a new get receipt settings request DTO.
     *
     * @param  string  $id  The fiscal identifier of the Business Registry Configuration
     */
    public function __construct(
        public string $id,
    ) {}
}
