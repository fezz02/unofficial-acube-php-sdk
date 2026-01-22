<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\BusinessRegistryConfigurationDto;

test('business registry configuration dto can be created', function (): void {
    $dto = new BusinessRegistryConfigurationDto(
        fiscal_id: '12345678901',
        name: 'Test Company',
        email: 'test@example.com',
        supplier_invoice_enabled: true,
        receipts_enabled: false,
    );

    expect($dto)
        ->toBeInstanceOf(BusinessRegistryConfigurationDto::class)
        ->and($dto->fiscal_id)->toBe('12345678901')
        ->and($dto->name)->toBe('Test Company')
        ->and($dto->supplier_invoice_enabled)->toBeTrue()
        ->and($dto->receipts_enabled)->toBeFalse();
});

test('business registry configuration dto can be created from array', function (): void {
    $dto = BusinessRegistryConfigurationDto::from([
        'fiscal_id' => '98765432101',
        'name' => 'Another Company',
        'email' => 'another@example.com',
    ]);

    expect($dto)
        ->toBeInstanceOf(BusinessRegistryConfigurationDto::class)
        ->and($dto->fiscal_id)->toBe('98765432101')
        ->and($dto->name)->toBe('Another Company');
});

