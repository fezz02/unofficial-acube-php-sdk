<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\DeleteBusinessRegistryConfigurationRequestDto;

test('delete business registry configuration request dto can be created', function (): void {
    $dto = new DeleteBusinessRegistryConfigurationRequestDto(
        id: '12345678901'
    );

    expect($dto)
        ->toBeInstanceOf(DeleteBusinessRegistryConfigurationRequestDto::class)
        ->and($dto->id)->toBe('12345678901');
});

test('delete business registry configuration request dto can be created from array', function (): void {
    $dto = DeleteBusinessRegistryConfigurationRequestDto::from([
        'id' => '98765432101',
    ]);

    expect($dto)
        ->toBeInstanceOf(DeleteBusinessRegistryConfigurationRequestDto::class)
        ->and($dto->id)->toBe('98765432101');
});

