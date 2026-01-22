<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\User\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for create user sub-account response.
 *
 * Represents the response from creating a new user sub-account.
 * Note: Based on the API documentation, the actual response contains
 * the created sub-account data, not just a token.
 *
 * @see https://docs.acubeapi.com/documentation/common/user/#create-user-sub-account
 */
final readonly class CreateUserSubAccountResponseDto extends Dto
{
    /**
     * Create a new create sub-account response DTO.
     *
     * @param  string  $token  The token (note: actual API response may contain full sub-account data)
     */
    public function __construct(
        public string $token
    ) {}
}
