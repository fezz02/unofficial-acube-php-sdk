<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Common\User\Dto\UpdateUserSubAccountRequestDto;

test('update user sub account request dto can be created', function (): void {
    $dto = new UpdateUserSubAccountRequestDto(
        fullname: 'Updated Name',
        enabled: true
    );

    expect($dto)
        ->toBeInstanceOf(UpdateUserSubAccountRequestDto::class)
        ->and($dto->fullname)->toBe('Updated Name')
        ->and($dto->enabled)->toBeTrue();
});

test('update user sub account request dto can handle null values', function (): void {
    $dto = new UpdateUserSubAccountRequestDto(
        fullname: null,
        enabled: null
    );

    expect($dto)
        ->toBeInstanceOf(UpdateUserSubAccountRequestDto::class)
        ->and($dto->fullname)->toBeNull()
        ->and($dto->enabled)->toBeNull();
});

test('update user sub account request dto can be created from array', function (): void {
    $dto = UpdateUserSubAccountRequestDto::from([
        'fullname' => 'From Array',
        'enabled' => false,
    ]);

    expect($dto)
        ->toBeInstanceOf(UpdateUserSubAccountRequestDto::class)
        ->and($dto->fullname)->toBe('From Array')
        ->and($dto->enabled)->toBeFalse();
});
