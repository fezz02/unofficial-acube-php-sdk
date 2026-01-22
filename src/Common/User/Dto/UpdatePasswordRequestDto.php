<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\User\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for updating a password.
 *
 * This DTO contains the password data required to update a user's or sub-account's password.
 *
 * @see https://docs.acubeapi.com/documentation/common/user/
 */
final readonly class UpdatePasswordRequestDto extends Dto
{
    /**
     * Create a new update password request DTO.
     *
     * @param  string  $password  The new password (must meet A-Cube's password requirements)
     */
    public function __construct(
        public string $password
    ) {}
}
