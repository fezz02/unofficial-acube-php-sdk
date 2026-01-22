<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\AppointFisconlineRequestDto;

test('appoint fisconline request dto can be created', function (): void {
    $dto = new AppointFisconlineRequestDto(
        id: '12345678901',
        appointee_fiscal_id: 'A-CUBE',
        codice_fiscale: 'RSSMRA80A01H501U',
        password: 'password123',
        pin: '1234',
    );

    expect($dto)
        ->toBeInstanceOf(AppointFisconlineRequestDto::class)
        ->and($dto->id)->toBe('12345678901')
        ->and($dto->appointee_fiscal_id)->toBe('A-CUBE');
});

test('appoint fisconline request dto can be created from array', function (): void {
    $dto = AppointFisconlineRequestDto::from([
        'id' => '98765432101',
        'appointee_fiscal_id' => 'A-CUBE',
        'codice_fiscale' => 'RSSMRA80A01H501U',
        'password' => 'password123',
        'pin' => '1234',
    ]);

    expect($dto)
        ->toBeInstanceOf(AppointFisconlineRequestDto::class)
        ->and($dto->codice_fiscale)->toBe('RSSMRA80A01H501U');
});

