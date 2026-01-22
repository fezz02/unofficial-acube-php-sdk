<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\AddSubAccountRequestDto;

test('add sub account request dto can be created', function (): void {
    $dto = new AddSubAccountRequestDto(
        id: '12345678901',
        email: 'subaccount@example.com',
        password: 'password123',
    );

    expect($dto)
        ->toBeInstanceOf(AddSubAccountRequestDto::class)
        ->and($dto->id)->toBe('12345678901')
        ->and($dto->email)->toBe('subaccount@example.com');
});

test('add sub account request dto can be created from array', function (): void {
    $dto = AddSubAccountRequestDto::from([
        'id' => '98765432101',
        'email' => 'another@example.com',
    ]);

    expect($dto)
        ->toBeInstanceOf(AddSubAccountRequestDto::class)
        ->and($dto->email)->toBe('another@example.com');
});

