<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\UpdateBusinessRegistryConfigurationRequestDto;

test('update business registry configuration request dto can be created', function (): void {
    $dto = new UpdateBusinessRegistryConfigurationRequestDto(
        fiscal_id: '12345678901',
        name: 'Updated Company',
        email: 'updated@example.com',
        receipts_enabled: true,
    );

    expect($dto)
        ->toBeInstanceOf(UpdateBusinessRegistryConfigurationRequestDto::class)
        ->and($dto->fiscal_id)->toBe('12345678901')
        ->and($dto->receipts_enabled)->toBeTrue();
});

test('update business registry configuration request dto can be created from array', function (): void {
    $dto = UpdateBusinessRegistryConfigurationRequestDto::from([
        'fiscal_id' => '98765432101',
        'supplier_invoice_enabled' => false,
    ]);

    expect($dto)
        ->toBeInstanceOf(UpdateBusinessRegistryConfigurationRequestDto::class)
        ->and($dto->supplier_invoice_enabled)->toBeFalse();
});

