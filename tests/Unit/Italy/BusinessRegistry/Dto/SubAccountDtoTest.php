<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\SubAccountDto;

test('sub account dto can be created', function (): void {
    $dto = new SubAccountDto(
        email: 'subaccount@example.com'
    );

    expect($dto)
        ->toBeInstanceOf(SubAccountDto::class)
        ->and($dto->email)->toBe('subaccount@example.com');
});

test('sub account dto can be created from array', function (): void {
    $dto = SubAccountDto::from([
        'email' => 'another@example.com',
    ]);

    expect($dto)
        ->toBeInstanceOf(SubAccountDto::class)
        ->and($dto->email)->toBe('another@example.com');
});

