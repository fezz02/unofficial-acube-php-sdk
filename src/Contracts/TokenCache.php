<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Contracts;

use Fezz\Acube\Sdk\Authentication\AccessTokenAuthenticator;
use Fezz\Acube\Sdk\Exceptions\Authentication\TokenNotFoundException;

/**
 * Contract for caching access token authenticators.
 *
 * Implementations are responsible for storing and retrieving
 * {@see AccessTokenAuthenticator} instances using a string-based cache key.
 *
 * The cache key MUST uniquely identify the authentication context, for example:
 * - API endpoint (sandbox / production)
 * - Service (common / italy)
 * - Account or credentials identity
 * - Optional custom namespace
 *
 * This interface is intentionally storage-agnostic:
 * implementations may use in-memory storage, filesystem, database,
 * distributed cache, or any other medium.
 *
 * ⚠️ Security note:
 * This SDK does NOT provide secure or encrypted storage by default.
 * Consumers are responsible for ensuring tokens are stored safely
 * when using persistent or shared storage mechanisms.
 */
interface TokenCache
{
    /**
     * Retrieve a cached AccessTokenAuthenticator by key.
     *
     * Implementations SHOULD:
     * - Return a valid authenticator if present and not expired
     * - Throw {@see TokenNotFoundException} if the token is missing or expired
     *
     * @param  string  $key  A unique cache key identifying the authentication context
     *
     * @throws TokenNotFoundException If no valid authenticator is available
     */
    public function get(string $key): AccessTokenAuthenticator;

    /**
     * Store an AccessTokenAuthenticator in the cache.
     *
     * Implementations SHOULD overwrite any existing authenticator
     * associated with the same key.
     *
     * @param  string  $key  A unique cache key identifying the authentication context
     * @param  AccessTokenAuthenticator  $authenticator  The authenticator to cache
     */
    public function set(string $key, AccessTokenAuthenticator $authenticator): void;

    /**
     * Remove a cached authenticator for the given key.
     *
     * This forces a new authentication flow the next time
     * the same key is requested.
     *
     * @param  string  $key  A unique cache key identifying the authentication context
     */
    public function forget(string $key): void;

    /**
     * Clear all cached authenticators.
     *
     * Implementations SHOULD remove all stored tokens,
     * regardless of key or namespace.
     *
     * This is primarily intended for:
     * - test environments
     * - manual cache resets
     * - application shutdown or reset scenarios
     */
    public function clear(): void;
}
