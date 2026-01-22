<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Authentication\AccessTokenAuthenticator;
use Fezz\Acube\Sdk\Authentication\Dto\AuthenticationUsefulInformationDto;
use Fezz\Acube\Sdk\Tests\Fixtures\Authentication\_UnsafeInMemoryTokenCache as UnsafeInMemoryTokenCache;

it('returns useful information dto from a valid jwt token', function (): void {
    $payload = [
        'iat' => 1_700_000_000,
        'exp' => 1_700_086_400,
        'roles' => [
            'it.api.acubeapi.com' => ['ROLE_WRITER', 'ROLE_READER'],
        ],
        'username' => 'user@example.com',
        'uid' => 123,
    ];

    $payloadPart = base64_encode(json_encode($payload, JSON_THROW_ON_ERROR));

    // header and signature can be any non-empty strings for our test
    $jwt = 'header.' . $payloadPart . '.signature';

    $authenticator = new AccessTokenAuthenticator($jwt);

    $cache = new UnsafeInMemoryTokenCache;
    $cache->set('default', $authenticator);

    $dto = $cache->usefulInformation('default');

    expect($dto)->toBeInstanceOf(AuthenticationUsefulInformationDto::class)
        ->and($dto->iat)->toBe(1_700_000_000)
        ->and($dto->exp)->toBe(1_700_086_400)
        ->and($dto->username)->toBe('user@example.com')
        ->and($dto->uid)->toBe(123)
        ->and($dto->roles['it.api.acubeapi.com'])->toBe(['ROLE_WRITER', 'ROLE_READER']);
});
