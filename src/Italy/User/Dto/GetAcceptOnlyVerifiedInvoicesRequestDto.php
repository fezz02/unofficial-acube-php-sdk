<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\User\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for getting the "accept only verified invoices" status.
 *
 * This DTO encapsulates the user ID path parameter.
 */
final readonly class GetAcceptOnlyVerifiedInvoicesRequestDto extends Dto
{
    /**
     * Create a new get accept only verified invoices request DTO.
     *
     * @param  string  $id  The user ID
     */
    public function __construct(
        public string $id,
    ) {}
}
