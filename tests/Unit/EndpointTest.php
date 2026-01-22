<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Concerns\Endpoint;

test('endpoint enum has correct values', function (): void {
    expect(Endpoint::COMMON_PRODUCTION->value)->toBe('https://common.api.acubeapi.com')
        ->and(Endpoint::COMMON_SANDBOX->value)->toBe('https://common-sandbox.api.acubeapi.com')
        ->and(Endpoint::ITALY_PRODUCTION->value)->toBe('https://api.acubeapi.com')
        ->and(Endpoint::ITALY_SANDBOX->value)->toBe('https://api-sandbox.acubeapi.com');
});

test('isSandbox returns true for sandbox endpoints', function (): void {
    expect(Endpoint::isSandbox(Endpoint::COMMON_SANDBOX))->toBeTrue()
        ->and(Endpoint::isSandbox(Endpoint::ITALY_SANDBOX))->toBeTrue();
});

test('isSandbox returns false for production endpoints', function (): void {
    expect(Endpoint::isSandbox(Endpoint::COMMON_PRODUCTION))->toBeFalse()
        ->and(Endpoint::isSandbox(Endpoint::ITALY_PRODUCTION))->toBeFalse();
});

test('host returns hostname without protocol', function (): void {
    expect(Endpoint::host(Endpoint::COMMON_PRODUCTION))->toBe('common.api.acubeapi.com')
        ->and(Endpoint::host(Endpoint::COMMON_SANDBOX))->toBe('common-sandbox.api.acubeapi.com')
        ->and(Endpoint::host(Endpoint::ITALY_PRODUCTION))->toBe('api.acubeapi.com')
        ->and(Endpoint::host(Endpoint::ITALY_SANDBOX))->toBe('api-sandbox.acubeapi.com');
});

test('label returns correct labels for all endpoints', function (): void {
    expect(Endpoint::COMMON_PRODUCTION->label())->toBe('Common API - Production')
        ->and(Endpoint::COMMON_SANDBOX->label())->toBe('Common API - Sandbox')
        ->and(Endpoint::ITALY_PRODUCTION->label())->toBe('Italy API - Production')
        ->and(Endpoint::ITALY_SANDBOX->label())->toBe('Italy API - Sandbox');
});
