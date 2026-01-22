<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\UpdateReceiptSettingsRequestDto;

test('update receipt settings request dto can be created', function (): void {
    $dto = new UpdateReceiptSettingsRequestDto(
        id: '12345678901',
        phone_number: '+3912345678',
        receipts_alert_recipients: ['alert@example.com'],
    );

    expect($dto)
        ->toBeInstanceOf(UpdateReceiptSettingsRequestDto::class)
        ->and($dto->id)->toBe('12345678901')
        ->and($dto->phone_number)->toBe('+3912345678');
});

test('update receipt settings request dto can be created from array', function (): void {
    $dto = UpdateReceiptSettingsRequestDto::from([
        'id' => '98765432101',
        'phone_number' => '+3998765432',
    ]);

    expect($dto)
        ->toBeInstanceOf(UpdateReceiptSettingsRequestDto::class)
        ->and($dto->phone_number)->toBe('+3998765432');
});

