<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Authentication\AccessTokenAuthenticator;
use Fezz\Acube\Sdk\Tests\Fixtures\Authentication\_UnsafeInMemoryTokenCache as UnsafeInMemoryTokenCache;
use Fezz\Acube\Sdk\Exceptions\Authentication\InvalidTokenFormatException;
use Fezz\Acube\Sdk\Exceptions\Authentication\TokenNotFoundException;

it('throws exception when getting empty cache', function (): void {
    $cache = new UnsafeInMemoryTokenCache;
    $cache->clear();

    $cache->get('default');
})->throws(TokenNotFoundException::class);

it('stores and retrieves an authenticator', function (): void {
    $cache = new UnsafeInMemoryTokenCache;
    $authenticator = new AccessTokenAuthenticator('token');

    $cache->set('default', $authenticator);

    expect($cache->get('default'))
        ->toBeInstanceOf(AccessTokenAuthenticator::class)
        ->getAccessToken()->toBe('token');
});

it('clears the cache', function (): void {
    $cache = new UnsafeInMemoryTokenCache;
    $authenticator = new AccessTokenAuthenticator('token');

    $cache->set('default', $authenticator);
    $cache->clear();

    $cache->get('default');
})->throws(TokenNotFoundException::class);

it('throws TokenNotFoundException when no token is cached', function (): void {
    $cache = new UnsafeInMemoryTokenCache;
    $cache->clear();

    $cache->usefulInformation('default');
})->throws(TokenNotFoundException::class);

it('throws InvalidTokenFormatException when token does not contain three parts', function (): void {
    $authenticator = new AccessTokenAuthenticator('invalid-token-without-dots');

    $cache = new UnsafeInMemoryTokenCache;
    $cache->set('default', $authenticator);

    $cache->usefulInformation('default');
})->throws(InvalidTokenFormatException::class);

it('throws InvalidTokenFormatException when jwt payload is not valid base64', function (): void {
    // three parts but second one is not valid
    $jwt = 'header.%@@not-base64@@%.signature';

    $authenticator = new AccessTokenAuthenticator($jwt);
    $cache = new UnsafeInMemoryTokenCache;
    $cache->set('default', $authenticator);

    $cache->usefulInformation('default');
})->throws(InvalidTokenFormatException::class);
