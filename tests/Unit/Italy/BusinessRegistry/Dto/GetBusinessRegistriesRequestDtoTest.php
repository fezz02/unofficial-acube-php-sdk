<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\GetBusinessRegistriesRequestDto;

test('get business registries request dto can be created', function (): void {
    $dto = new GetBusinessRegistriesRequestDto(
        simpleSearch: 'Test Company',
        page: 1
    );

    expect($dto)
        ->toBeInstanceOf(GetBusinessRegistriesRequestDto::class)
        ->and($dto->simpleSearch)->toBe('Test Company')
        ->and($dto->page)->toBe(1);
});

test('get business registries request dto can be created from array', function (): void {
    $dto = GetBusinessRegistriesRequestDto::from([
        'simpleSearch' => 'Another Company',
        'page' => 2,
    ]);

    expect($dto)
        ->toBeInstanceOf(GetBusinessRegistriesRequestDto::class)
        ->and($dto->simpleSearch)->toBe('Another Company')
        ->and($dto->page)->toBe(2);
});

