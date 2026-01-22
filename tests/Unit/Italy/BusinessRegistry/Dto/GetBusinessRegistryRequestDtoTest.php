<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\GetBusinessRegistryRequestDto;

test('get business registry request dto can be created', function (): void {
    $dto = new GetBusinessRegistryRequestDto(
        id: '12345678901'
    );

    expect($dto)
        ->toBeInstanceOf(GetBusinessRegistryRequestDto::class)
        ->and($dto->id)->toBe('12345678901');
});

test('get business registry request dto can be created from array', function (): void {
    $dto = GetBusinessRegistryRequestDto::from([
        'id' => '98765432101',
    ]);

    expect($dto)
        ->toBeInstanceOf(GetBusinessRegistryRequestDto::class)
        ->and($dto->id)->toBe('98765432101');
});

