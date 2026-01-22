<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\ApiConfiguration\Requests\DeleteApiConfigurationRequest;

test('delete api configuration resolveEndpoint returns correct path', function (): void {
    $request = new DeleteApiConfigurationRequest('cfg-123');

    expect($request->resolveEndpoint())->toBe('/api-configurations/cfg-123');
});

test('delete api configuration defaultHeaders return json accept', function (): void {
    $request = new DeleteApiConfigurationRequest('cfg-123');

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');
    /** @var array<string, string> $headers */
    $headers = $method->invoke($request);

    expect($headers)
        ->toHaveKey('Accept', 'application/json');
});




