<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\User\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for updating a user password.
 *
 * This DTO contains the user ID and password data required to update a user's password.
 * Use "me" to update the current authenticated user's password.
 *
 * @see https://docs.acubeapi.com/documentation/common/user/
 */
final readonly class UpdateUserPasswordRequestDto extends Dto
{
    /**
     * Create a new update user password request DTO.
     *
     * @param  string  $id  The user ID (can be "me" for the current user, defaults to "me")
     * @param  string  $password  The new password (must meet A-Cube's password requirements)
     */
    public function __construct(
        public string $id,
        public string $password
    ) {}
}
