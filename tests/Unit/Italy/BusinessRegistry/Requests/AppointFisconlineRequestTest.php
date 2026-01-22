<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\AppointFisconlineRequestDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\AppointFisconlineRequest;
use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new AppointFisconlineRequestDto(
        id: '12345678901',
        appointee_fiscal_id: 'A-CUBE',
        codice_fiscale: 'RSSMRA80A01H501U',
        password: 'password123',
        pin: '1234',
    );
    $request = new AppointFisconlineRequest($dto);

    expect($request->resolveEndpoint())->toBe('/business-registry-configurations/12345678901/appoint/fisconline');
});

test('defaultBody returns correct body', function (): void {
    $dto = new AppointFisconlineRequestDto(
        id: '12345678901',
        appointee_fiscal_id: 'A-CUBE',
        codice_fiscale: 'RSSMRA80A01H501U',
        password: 'password123',
        pin: '1234',
    );
    $request = new AppointFisconlineRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultBody');
    $body = $method->invoke($request);

    expect($body)->toBeArray()
        ->and($body['appointee_fiscal_id'])->toBe('A-CUBE')
        ->and($body['codice_fiscale'])->toBe('RSSMRA80A01H501U')
        ->and($body['password'])->toBe('password123')
        ->and($body['pin'])->toBe('1234');
});

