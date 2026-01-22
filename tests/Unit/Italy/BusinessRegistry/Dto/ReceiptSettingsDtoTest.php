<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\ReceiptSettingsDto;

test('receipt settings dto can be created', function (): void {
    $dto = new ReceiptSettingsDto(
        receipts_alert_recipients: ['alert1@example.com', 'alert2@example.com'],
        phone_number: '+3912345678',
    );

    expect($dto)
        ->toBeInstanceOf(ReceiptSettingsDto::class)
        ->and($dto->phone_number)->toBe('+3912345678')
        ->and($dto->receipts_alert_recipients)->toHaveCount(2);
});

test('receipt settings dto can be created from array', function (): void {
    $dto = ReceiptSettingsDto::from([
        'phone_number' => '+3998765432',
        'receipts_alert_recipients' => ['alert@example.com'],
    ]);

    expect($dto)
        ->toBeInstanceOf(ReceiptSettingsDto::class)
        ->and($dto->receipts_alert_recipients)->toHaveCount(1);
});

