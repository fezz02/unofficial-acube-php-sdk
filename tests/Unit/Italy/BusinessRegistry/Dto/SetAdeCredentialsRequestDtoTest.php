<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\SetAdeCredentialsRequestDto;

test('set ade credentials request dto can be created', function (): void {
    $dto = new SetAdeCredentialsRequestDto(
        id: '12345678901',
        codice_fiscale: 'RSSMRA80A01H501U',
        password: 'password123',
        pin: '1234',
    );

    expect($dto)
        ->toBeInstanceOf(SetAdeCredentialsRequestDto::class)
        ->and($dto->id)->toBe('12345678901')
        ->and($dto->codice_fiscale)->toBe('RSSMRA80A01H501U');
});

test('set ade credentials request dto can be created from array', function (): void {
    $dto = SetAdeCredentialsRequestDto::from([
        'id' => '98765432101',
        'codice_fiscale' => 'VRDLGI80A01H501U',
        'password' => 'password456',
        'pin' => '5678',
    ]);

    expect($dto)
        ->toBeInstanceOf(SetAdeCredentialsRequestDto::class)
        ->and($dto->pin)->toBe('5678');
});

