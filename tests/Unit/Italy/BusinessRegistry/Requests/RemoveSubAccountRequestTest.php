<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\RemoveSubAccountRequestDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\RemoveSubAccountRequest;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new RemoveSubAccountRequestDto(
        id: '12345678901',
        email: 'subaccount@example.com'
    );
    $request = new RemoveSubAccountRequest($dto);

    expect($request->resolveEndpoint())->toBe('/business-registry-configurations/12345678901/sub-accounts/subaccount@example.com');
});

test('defaultHeaders returns correct headers', function (): void {
    $dto = new RemoveSubAccountRequestDto(
        id: '12345678901',
        email: 'subaccount@example.com'
    );
    $request = new RemoveSubAccountRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');
    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers['Accept'])->toBe('application/json');
});

