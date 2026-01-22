<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\AppointStatusDto;

test('appoint status dto can be created', function (): void {
    $dto = new AppointStatusDto(
        receipt_enabled: true,
        appointee: 'A-CUBE',
        status: 'completed',
        url: 'https://example.com/status',
    );

    expect($dto)
        ->toBeInstanceOf(AppointStatusDto::class)
        ->and($dto->receipt_enabled)->toBeTrue()
        ->and($dto->status)->toBe('completed');
});

test('appoint status dto can be created from array', function (): void {
    $dto = AppointStatusDto::from([
        'receipt_enabled' => false,
        'appointee' => '12345678901',
        'status' => 'pending',
    ]);

    expect($dto)
        ->toBeInstanceOf(AppointStatusDto::class)
        ->and($dto->receipt_enabled)->toBeFalse();
});

