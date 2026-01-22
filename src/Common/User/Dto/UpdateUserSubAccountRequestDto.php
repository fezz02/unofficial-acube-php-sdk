<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\User\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for updating a user sub-account.
 *
 * This DTO contains the data required to update an existing sub-account.
 * The ID is passed separately as a path parameter.
 *
 * @see https://docs.acubeapi.com/documentation/common/user/
 */
final readonly class UpdateUserSubAccountRequestDto extends Dto
{
    /**
     * Create a new update sub-account request DTO.
     *
     * @param  string|null  $fullname  The full name of the sub-account holder (optional)
     * @param  bool|null  $enabled  Whether the sub-account should be enabled (optional, defaults to true)
     */
    public function __construct(
        public ?string $fullname,
        public ?bool $enabled
    ) {}
}
