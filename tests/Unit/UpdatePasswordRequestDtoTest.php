<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Common\User\Dto\UpdatePasswordRequestDto;

test('update password request dto can be created', function (): void {
    $dto = new UpdatePasswordRequestDto('NewPassword123!');

    expect($dto)
        ->toBeInstanceOf(UpdatePasswordRequestDto::class)
        ->and($dto->password)->toBe('NewPassword123!');
});

test('update password request dto can be created from array', function (): void {
    $dto = UpdatePasswordRequestDto::from(['password' => 'AnotherPassword456!']);

    expect($dto)
        ->toBeInstanceOf(UpdatePasswordRequestDto::class)
        ->and($dto->password)->toBe('AnotherPassword456!');
});
