<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Common\User\Dto\DeleteUserSubAccountRequestDto;

test('delete user sub account request dto can be created', function (): void {
    $dto = new DeleteUserSubAccountRequestDto(
        id: 'sub-account-123'
    );

    expect($dto)
        ->toBeInstanceOf(DeleteUserSubAccountRequestDto::class)
        ->and($dto->id)->toBe('sub-account-123');
});

test('delete user sub account request dto can be created from array', function (): void {
    $dto = DeleteUserSubAccountRequestDto::from([
        'id' => 'sub-account-456',
    ]);

    expect($dto)
        ->toBeInstanceOf(DeleteUserSubAccountRequestDto::class)
        ->and($dto->id)->toBe('sub-account-456');
});
