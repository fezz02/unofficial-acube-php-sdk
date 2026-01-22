<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\DeleteBusinessRegistryRequestDto;

test('delete business registry request dto can be created', function (): void {
    $dto = new DeleteBusinessRegistryRequestDto(
        id: '12345678901'
    );

    expect($dto)
        ->toBeInstanceOf(DeleteBusinessRegistryRequestDto::class)
        ->and($dto->id)->toBe('12345678901');
});

test('delete business registry request dto can be created from array', function (): void {
    $dto = DeleteBusinessRegistryRequestDto::from([
        'id' => '98765432101',
    ]);

    expect($dto)
        ->toBeInstanceOf(DeleteBusinessRegistryRequestDto::class)
        ->and($dto->id)->toBe('98765432101');
});

