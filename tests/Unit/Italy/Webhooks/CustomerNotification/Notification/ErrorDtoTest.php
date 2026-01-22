<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\Webhooks\CustomerNotification\Notification\ErrorDto;

test('can create error data from array with Codice and Descrizione', function (): void {
    $data = [
        'Codice' => '00100',
        'Descrizione' => 'Certificato di firma scaduto',
    ];

    $dto = ErrorDto::from($data);

    expect($dto)
        ->toBeInstanceOf(ErrorDto::class)
        ->and($dto->codice)->toBe('00100')
        ->and($dto->descrizione)->toBe('Certificato di firma scaduto');
});

test('can create error data from array with lowercase keys', function (): void {
    $data = [
        'codice' => '00101',
        'descrizione' => 'Test error',
    ];

    $dto = ErrorDto::from($data);

    expect($dto)
        ->toBeInstanceOf(ErrorDto::class)
        ->and($dto->codice)->toBe('00101')
        ->and($dto->descrizione)->toBe('Test error');
});

test('can create error data with empty strings when keys are missing', function (): void {
    $data = [];

    $dto = ErrorDto::from($data);

    expect($dto)
        ->toBeInstanceOf(ErrorDto::class)
        ->and($dto->codice)->toBe('')
        ->and($dto->descrizione)->toBe('');
});

