<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\User\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for retrieving a user sub account.
 *
 * This DTO contains the identifier of the sub account to retrieve.
 */
final readonly class GetUserSubAccountRequestDto extends Dto
{
    public function __construct(
        public string $id,
    ) {}
}
