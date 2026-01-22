<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\GetReceiptSettingsRequestDto;

test('get receipt settings request dto can be created', function (): void {
    $dto = new GetReceiptSettingsRequestDto(
        id: '12345678901'
    );

    expect($dto)
        ->toBeInstanceOf(GetReceiptSettingsRequestDto::class)
        ->and($dto->id)->toBe('12345678901');
});

test('get receipt settings request dto can be created from array', function (): void {
    $dto = GetReceiptSettingsRequestDto::from([
        'id' => '98765432101',
    ]);

    expect($dto)
        ->toBeInstanceOf(GetReceiptSettingsRequestDto::class)
        ->and($dto->id)->toBe('98765432101');
});

