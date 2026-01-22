<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\GetBusinessRegistryConfigurationsRequestDto;

test('get business registry configurations request dto can be created', function (): void {
    $dto = new GetBusinessRegistryConfigurationsRequestDto(
        fiscal_id: '12345678901',
        page: 1
    );

    expect($dto)
        ->toBeInstanceOf(GetBusinessRegistryConfigurationsRequestDto::class)
        ->and($dto->fiscal_id)->toBe('12345678901')
        ->and($dto->page)->toBe(1);
});

test('get business registry configurations request dto can be created from array', function (): void {
    $dto = GetBusinessRegistryConfigurationsRequestDto::from([
        'fiscal_id' => '98765432101',
        'email' => 'test@example.com',
    ]);

    expect($dto)
        ->toBeInstanceOf(GetBusinessRegistryConfigurationsRequestDto::class)
        ->and($dto->fiscal_id)->toBe('98765432101')
        ->and($dto->email)->toBe('test@example.com');
});

