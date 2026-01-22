<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Contracts;

use Fezz\Acube\Sdk\Authentication\Dto\AuthenticationUsefulInformationDto;
use Fezz\Acube\Sdk\Exceptions\Authentication\InvalidTokenFormatException;

/**
 * Interface for classes that can decode JWT tokens and extract useful information.
 */
interface DecodesToken
{
    /**
     * Decode and return useful information from a JWT token.
     *
     * It extracts fields like `iat`, `exp`, `roles`, `username` and `uid`
     * which are embedded in the JWT response from A-Cube.
     *
     * @param  string  $token  The JWT token string to decode
     * @return AuthenticationUsefulInformationDto The decoded token information
     *
     * @throws InvalidTokenFormatException If the token is not a valid JWT or payload is malformed.
     */
    public function decode(string $token): AuthenticationUsefulInformationDto;
}
