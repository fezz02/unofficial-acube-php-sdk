<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Authentication;

use Fezz\Acube\Sdk\Authentication\Dto\AuthenticationUsefulInformationDto;
use Fezz\Acube\Sdk\Contracts\DecodesToken;
use Fezz\Acube\Sdk\Exceptions\Authentication\InvalidTokenFormatException;

/**
 * Utility class for decoding JWT tokens and extracting useful information.
 *
 * This class provides a simple way to decode JWT tokens without requiring
 * a TokenCache instance. It extracts fields like `iat`, `exp`, `roles`,
 * `username` and `uid` from the token payload.
 *
 * @see https://docs.acubeapi.com/documentation/common/authentication/
 */
final class TokenDecoder implements DecodesToken
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
    public function decode(string $token): AuthenticationUsefulInformationDto
    {
        // Exploding the token by .
        $parts = explode('.', $token);

        if (count($parts) !== 3) {
            throw new InvalidTokenFormatException('Token is not stored in valid JWT format.');
        }

        // base64 decode of the second part
        $payload = base64_decode($parts[1], true);

        if ($payload === false) {
            throw new InvalidTokenFormatException('Second part of Token does not contain a valid payload. Could not base64 decode.');
        }

        /**
         * @var array<string, mixed>|null $decoded
         */
        $decoded = json_decode($payload, true);

        if (json_last_error() !== JSON_ERROR_NONE || ! is_array($decoded)) {
            throw new InvalidTokenFormatException('Token payload is not valid JSON: '.json_last_error_msg());
        }

        // Validate required fields
        $requiredFields = ['iat', 'exp', 'roles', 'username', 'uid'];
        foreach ($requiredFields as $field) {
            if (! isset($decoded[$field])) {
                throw new InvalidTokenFormatException("Token payload is missing required field: {$field}");
            }
        }

        /**
         * @var array{
         *     iat: int,
         *     exp: int,
         *     roles: array<string, list<string>>,
         *     username: string,
         *     uid: int|string
         * } $decoded
         */
        return new AuthenticationUsefulInformationDto(
            iat: (int) $decoded['iat'],
            exp: (int) $decoded['exp'],
            roles: $decoded['roles'],
            username: (string) $decoded['username'],
            uid: (int) $decoded['uid'],
        );
    }
}
