<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\ResetLegalStoragePasswordRequest;

test('resolveEndpoint returns correct path', function (): void {
    $request = new ResetLegalStoragePasswordRequest('12345678901');

    expect($request->resolveEndpoint())->toBe('/business-registry-configurations/12345678901/reset-legal-storage-password');
});

test('defaultHeaders returns correct headers', function (): void {
    $request = new ResetLegalStoragePasswordRequest('12345678901');

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');
    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers['Accept'])->toBe('application/json');
});

