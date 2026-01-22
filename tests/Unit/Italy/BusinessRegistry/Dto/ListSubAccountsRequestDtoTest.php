<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\ListSubAccountsRequestDto;

test('list sub accounts request dto can be created', function (): void {
    $dto = new ListSubAccountsRequestDto(
        id: '12345678901'
    );

    expect($dto)
        ->toBeInstanceOf(ListSubAccountsRequestDto::class)
        ->and($dto->id)->toBe('12345678901');
});

test('list sub accounts request dto can be created from array', function (): void {
    $dto = ListSubAccountsRequestDto::from([
        'id' => '98765432101',
    ]);

    expect($dto)
        ->toBeInstanceOf(ListSubAccountsRequestDto::class)
        ->and($dto->id)->toBe('98765432101');
});

