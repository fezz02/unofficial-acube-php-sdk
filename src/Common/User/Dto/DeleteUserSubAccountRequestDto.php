<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\User\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for deleting a user sub account.
 *
 * This DTO contains the identifier of the sub account to delete.
 */
final readonly class DeleteUserSubAccountRequestDto extends Dto
{
    public function __construct(
        public string $id,
    ) {}
}
