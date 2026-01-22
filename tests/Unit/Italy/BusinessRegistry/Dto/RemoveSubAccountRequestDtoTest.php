<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\RemoveSubAccountRequestDto;

test('remove sub account request dto can be created', function (): void {
    $dto = new RemoveSubAccountRequestDto(
        id: '12345678901',
        email: 'subaccount@example.com'
    );

    expect($dto)
        ->toBeInstanceOf(RemoveSubAccountRequestDto::class)
        ->and($dto->id)->toBe('12345678901')
        ->and($dto->email)->toBe('subaccount@example.com');
});

test('remove sub account request dto can be created from array', function (): void {
    $dto = RemoveSubAccountRequestDto::from([
        'id' => '98765432101',
        'email' => 'another@example.com',
    ]);

    expect($dto)
        ->toBeInstanceOf(RemoveSubAccountRequestDto::class)
        ->and($dto->email)->toBe('another@example.com');
});

