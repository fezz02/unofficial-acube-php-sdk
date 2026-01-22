<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\User\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for updating verified invoices status.
 *
 * This DTO encapsulates the ID and user data for updating verified supplier invoices status.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/users/
 */
final readonly class UpdateAcceptOnlyVerifiedInvoicesRequestDto extends Dto
{
    /**
     * Create a new update accept only verified invoices request DTO.
     *
     * @param  string  $id  The user ID
     * @param  array<string, mixed>  $user  The user data
     */
    public function __construct(
        public string $id,
        public array $user
    ) {}
}
