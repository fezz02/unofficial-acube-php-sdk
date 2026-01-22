<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Authentication;

use Saloon\Http\Auth\AccessTokenAuthenticator as SaloonAccessTokenAuthenticator;

/**
 * Authenticator for Acube API that applies a Bearer token to outgoing requests.
 *
 * Acube API uses a simple token-based authentication without refresh tokens.
 * This authenticator wraps Saloon's AccessTokenAuthenticator for simplicity,
 * but only uses the access token (no refresh token or expiration handling).
 *
 * Usage:
 *  $authenticator = new AccessTokenAuthenticator('token-value');
 *  $connector->authenticate($authenticator);
 */
final class AccessTokenAuthenticator extends SaloonAccessTokenAuthenticator
{
    /**
     * Create a new authenticator with just an access token.
     *
     * Note: Acube API does not provide refresh tokens or explicit expiration,
     * so we only set the access token. Tokens are valid until they expire or
     * are invalidated by the API (typically indicated by 401 responses).
     */
    public function __construct(string $accessToken)
    {
        parent::__construct($accessToken);
    }
}
