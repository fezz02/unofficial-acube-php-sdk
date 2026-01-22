<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\Authentication\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for login response.
 *
 * Represents the response from the `/login` endpoint, which contains
 * a JWT token that must be used for subsequent authenticated requests.
 *
 * @see https://docs.acubeapi.com/documentation/common/authentication/
 */
final readonly class LoginResponseDto extends Dto
{
    /**
     * Create a new login response DTO.
     *
     * @param  string  $token  The JWT token returned by the login endpoint
     */
    public function __construct(
        public string $token
    ) {}
}
