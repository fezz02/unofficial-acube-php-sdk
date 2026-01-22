<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\DeleteBusinessRegistryRequest;

test('resolveEndpoint returns correct path', function (): void {
    $request = new DeleteBusinessRegistryRequest('12345678901');

    expect($request->resolveEndpoint())->toBe('/business-registries/12345678901');
});

test('defaultHeaders returns correct headers', function (): void {
    $request = new DeleteBusinessRegistryRequest('12345678901');

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');
    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers['Accept'])->toBe('application/json');
});

