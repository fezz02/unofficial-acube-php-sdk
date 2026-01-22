<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\SetAdeCredentialsRequestDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\SetAdeCredentialsRequest;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new SetAdeCredentialsRequestDto(
        id: '12345678901',
        codice_fiscale: 'RSSMRA80A01H501U',
        password: 'password123',
        pin: '1234',
    );
    $request = new SetAdeCredentialsRequest($dto);

    expect($request->resolveEndpoint())->toBe('/business-registry-configurations/12345678901/credentials/fisconline');
});

test('defaultBody returns correct body', function (): void {
    $dto = new SetAdeCredentialsRequestDto(
        id: '12345678901',
        codice_fiscale: 'RSSMRA80A01H501U',
        password: 'password123',
        pin: '1234',
    );
    $request = new SetAdeCredentialsRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultBody');
    $body = $method->invoke($request);

    expect($body)->toBeArray()
        ->and($body['codice_fiscale'])->toBe('RSSMRA80A01H501U')
        ->and($body['password'])->toBe('password123')
        ->and($body['pin'])->toBe('1234');
});

