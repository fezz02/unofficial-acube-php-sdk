<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\ResetLegalStoragePasswordRequestDto;

test('reset legal storage password request dto can be created', function (): void {
    $dto = new ResetLegalStoragePasswordRequestDto(
        id: '12345678901'
    );

    expect($dto)
        ->toBeInstanceOf(ResetLegalStoragePasswordRequestDto::class)
        ->and($dto->id)->toBe('12345678901');
});

test('reset legal storage password request dto can be created from array', function (): void {
    $dto = ResetLegalStoragePasswordRequestDto::from([
        'id' => '98765432101',
    ]);

    expect($dto)
        ->toBeInstanceOf(ResetLegalStoragePasswordRequestDto::class)
        ->and($dto->id)->toBe('98765432101');
});

