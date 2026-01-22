<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Tests\Fixtures\Authentication;

use Fezz\Acube\Sdk\Contracts\TokenCache;
use Fezz\Acube\Sdk\Authentication\TokenDecoder;
use Fezz\Acube\Sdk\Authentication\AccessTokenAuthenticator;
use Fezz\Acube\Sdk\Exceptions\Authentication\TokenNotFoundException;
use Fezz\Acube\Sdk\Authentication\Dto\AuthenticationUsefulInformationDto;

/**
 * ⚠️ UNSAFE in-memory token cache.
 *
 * This cache stores access tokens in a static in-memory array and is scoped
 * to the current PHP process only.
 *
 * ⚠️ DO NOT USE in production with long-lived workers (Octane, Swoole,
 * RoadRunner, FrankenPHP) unless you fully understand the implications.
 *
 * Risks include:
 * - Token leakage across requests or users (shared process memory)
 * - Stale or expired tokens being reused
 * - No persistence guarantees and no isolation between logical sessions
 *
 * Security notes:
 * - Access tokens MUST be treated as secrets.
 * - Never log tokens, never expose them in exceptions, dumps, or debug output.
 * - If you need production usage, implement a persistent TokenCache that
 *   encrypts secrets at rest and applies proper access controls.
 *
 * This implementation is intended ONLY for:
 * - Local development
 * - CLI scripts
 * - Short-lived PHP processes
 *
 * Responsibility:
 * - Secure storage and encryption are the sole responsibility of the integrator.
 *   This SDK does not provide secure persistence by default.
 */
final class _UnsafeInMemoryTokenCache implements TokenCache
{
    /** @var array<string, AccessTokenAuthenticator> */
    private static array $tokens = [];

    private static bool $warningEmitted = false;

    public function __construct()
    {
        if (self::$warningEmitted) {
            return;
        }

        self::$warningEmitted = true;

        $message =
            "[Fezz\\Acube\\SDK] ⚠️ UnsafeInMemoryTokenCache in use.\n\n" .
            "This cache stores ACCESS TOKENS in plain process memory and is NOT safe for production.\n\n" .
            "SECURITY WARNING:\n" .
            "- Access tokens are secrets equivalent to credentials.\n" .
            "- Tokens MUST NOT be logged, dumped, or exposed in any form.\n" .
            "- Memory-based storage may leak tokens across requests or users\n" .
            "  when using long-lived PHP workers (Octane, Swoole, RoadRunner, FrankenPHP).\n\n" .
            "USE THIS CACHE ONLY FOR:\n" .
            "- Local development\n" .
            "- CLI scripts\n" .
            "- Short-lived PHP processes\n\n" .
            "PRODUCTION REQUIREMENTS:\n" .
            "- Implement your own TokenCache with encrypted, persistent storage\n" .
            "  (filesystem, Redis, database, HSM, etc.).\n" .
            "- Secure storage and encryption are the sole responsibility of the integrator.\n\n" .
            "See SDK documentation for security guidelines.\n";

        if (PHP_SAPI === 'cli' && defined('STDERR')) {
            fwrite(STDERR, "\n" . $message . "\n");
            return;
        }

        trigger_error($message, E_USER_WARNING);
    }

    public function get(string $key): AccessTokenAuthenticator
    {
        $authenticator = self::$tokens[$key] ?? null;

        if (! $authenticator instanceof AccessTokenAuthenticator) {
            throw new TokenNotFoundException(sprintf('Token not found for key "%s".', $key));
        }

        // IMPORTANT: you need a reliable expiry check.
        // Prefer implementing AccessTokenAuthenticator::hasExpired().
        if (method_exists($authenticator, 'hasExpired') && $authenticator->hasExpired()) {
            unset(self::$tokens[$key]);
            throw new TokenNotFoundException(sprintf('Token expired for key "%s".', $key));
        }

        return $authenticator;
    }

    public function set(string $key, AccessTokenAuthenticator $authenticator): void
    {
        self::$tokens[$key] = $authenticator;
    }

    public function forget(string $key): void
    {
        unset(self::$tokens[$key]);
    }

    public function clear(): void
    {
        self::$tokens = [];
    }

    /**
     * Optional helper (NOT part of TokenCache contract).
     * Decodes useful info from the cached JWT for a given key.
     *
     * @throws TokenNotFoundException
     */
    public function usefulInformation(string $key): AuthenticationUsefulInformationDto
    {
        $authenticator = $this->get($key);
        $decoder = new TokenDecoder;

        return $decoder->decode($authenticator->getAccessToken());
    }
}
