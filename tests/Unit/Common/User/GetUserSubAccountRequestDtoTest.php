<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Common\User\Dto\GetUserSubAccountRequestDto;

test('get user sub account request dto can be created', function (): void {
    $dto = new GetUserSubAccountRequestDto(
        id: 'sub-account-123'
    );

    expect($dto)
        ->toBeInstanceOf(GetUserSubAccountRequestDto::class)
        ->and($dto->id)->toBe('sub-account-123');
});

test('get user sub account request dto can be created from array', function (): void {
    $dto = GetUserSubAccountRequestDto::from([
        'id' => 'sub-account-456',
    ]);

    expect($dto)
        ->toBeInstanceOf(GetUserSubAccountRequestDto::class)
        ->and($dto->id)->toBe('sub-account-456');
});
