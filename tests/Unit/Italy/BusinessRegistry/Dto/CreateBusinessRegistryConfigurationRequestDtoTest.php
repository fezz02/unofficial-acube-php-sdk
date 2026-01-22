<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\CreateBusinessRegistryConfigurationRequestDto;

test('create business registry configuration request dto can be created', function (): void {
    $dto = new CreateBusinessRegistryConfigurationRequestDto(
        fiscal_id: '12345678901',
        name: 'Test Company',
        email: 'test@example.com',
        supplier_invoice_enabled: true,
    );

    expect($dto)
        ->toBeInstanceOf(CreateBusinessRegistryConfigurationRequestDto::class)
        ->and($dto->fiscal_id)->toBe('12345678901')
        ->and($dto->supplier_invoice_enabled)->toBeTrue();
});

test('create business registry configuration request dto can be created from array', function (): void {
    $dto = CreateBusinessRegistryConfigurationRequestDto::from([
        'fiscal_id' => '98765432101',
        'name' => 'Another Company',
    ]);

    expect($dto)
        ->toBeInstanceOf(CreateBusinessRegistryConfigurationRequestDto::class)
        ->and($dto->fiscal_id)->toBe('98765432101')
        ->and($dto->api_configurations)->toBe([]);
});

test('create business registry configuration request dto defaults api_configurations to empty array', function (): void {
    $dto = new CreateBusinessRegistryConfigurationRequestDto(
        fiscal_id: '12345678901'
    );

    expect($dto->api_configurations)->toBe([]);
});

test('create business registry configuration request dto can accept api_configurations', function (): void {
    $apiConfigs = [
        ['event' => 'supplier-invoice', 'target_url' => 'https://example.com/webhook'],
    ];

    $dto = new CreateBusinessRegistryConfigurationRequestDto(
        fiscal_id: '12345678901',
        api_configurations: $apiConfigs
    );

    expect($dto->api_configurations)->toBe($apiConfigs);
});

