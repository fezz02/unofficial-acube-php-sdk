<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\User\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for updating a sub-account password.
 *
 * This DTO contains the sub-account ID and password data required to update a sub-account's password.
 *
 * @see https://docs.acubeapi.com/documentation/common/user/
 */
final readonly class UpdateSubAccountPasswordRequestDto extends Dto
{
    /**
     * Create a new update sub-account password request DTO.
     *
     * @param  string  $id  The sub-account ID
     * @param  string  $password  The new password (must meet A-Cube's password requirements)
     */
    public function __construct(
        public string $id,
        public string $password
    ) {}
}
