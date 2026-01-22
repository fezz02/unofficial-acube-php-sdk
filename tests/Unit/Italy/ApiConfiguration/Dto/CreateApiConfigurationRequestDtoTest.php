<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\ApiConfiguration\Dto\CreateApiConfigurationRequestDto;

test('create api configuration request dto can be created', function (): void {
    $dto = new CreateApiConfigurationRequestDto(
        event: 'supplier-invoice',
        target_url: 'https://example.com/webhook',
        authentication_type: 'header',
        authentication_key: 'X-API-KEY',
        authentication_token: 'secret',
        business_registry_configurations: [['fiscal_id' => 'IT12345678901']],
    );

    expect($dto)
        ->toBeInstanceOf(CreateApiConfigurationRequestDto::class)
        ->and($dto->event)->toBe('supplier-invoice')
        ->and($dto->target_url)->toBe('https://example.com/webhook')
        ->and($dto->authentication_type)->toBe('header')
        ->and($dto->business_registry_configurations)->toHaveCount(1);
});

test('create api configuration request dto can be created from array', function (): void {
    $dto = CreateApiConfigurationRequestDto::from([
        'event' => 'customer-notification',
        'target_url' => 'https://example.com/notify',
        'authentication_type' => 'query',
    ]);

    expect($dto)
        ->toBeInstanceOf(CreateApiConfigurationRequestDto::class)
        ->and($dto->event)->toBe('customer-notification')
        ->and($dto->authentication_key)->toBeNull()
        ->and($dto->business_registry_configurations)->toBe([]);
});




