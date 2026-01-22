<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\ApiConfiguration\Dto\ApiConfigurationDto;

test('api configuration dto from array works', function (): void {
    $data = [
        'uuid' => 'uuid-123',
        'event' => 'supplier-invoice',
        'target_url' => 'https://example.com/webhook',
        'authentication_type' => 'header',
        'authentication_key' => 'X-API-KEY',
        'authentication_token' => 'secret',
        'business_registry_configurations' => [
            ['fiscal_id' => 'IT12345678901'],
        ],
    ];

    $dto = ApiConfigurationDto::from($data);

    expect($dto)
        ->toBeInstanceOf(ApiConfigurationDto::class)
        ->and($dto->uuid)->toBe('uuid-123')
        ->and($dto->event)->toBe('supplier-invoice')
        ->and($dto->target_url)->toBe('https://example.com/webhook')
        ->and($dto->authentication_type)->toBe('header')
        ->and($dto->authentication_key)->toBe('X-API-KEY')
        ->and($dto->authentication_token)->toBe('secret')
        ->and($dto->business_registry_configurations)->toHaveCount(1);
});





