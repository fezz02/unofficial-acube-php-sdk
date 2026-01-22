<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Common\Authentication\Dto\LoginResponseDto;

test('dto all method returns all properties', function (): void {
    $dto = LoginResponseDto::from(['token' => 'test-token-123']);

    $all = $dto->all();

    expect($all)->toBeArray()
        ->and($all)->toHaveKey('token')
        ->and($all['token'])->toBe('test-token-123');
});

test('dto from method creates instance from array', function (): void {
    $data = ['token' => 'test-token-456'];

    $dto = LoginResponseDto::from($data);

    expect($dto)
        ->toBeInstanceOf(LoginResponseDto::class)
        ->and($dto->token)->toBe('test-token-456');
});
