<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for getting a single invoice by UUID.
 *
 * This DTO encapsulates the invoice UUID path parameter.
 */
final readonly class GetInvoiceRequestDto extends Dto
{
    /**
     * Create a new get invoice request DTO.
     *
     * @param  string  $uuid  The invoice UUID
     */
    public function __construct(
        public string $uuid,
    ) {}
}
