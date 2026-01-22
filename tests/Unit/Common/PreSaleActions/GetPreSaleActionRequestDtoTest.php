<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Common\PreSaleActions\Dto\GetPreSaleActionRequestDto;

test('get pre-sale action request dto can be created', function (): void {
    $dto = new GetPreSaleActionRequestDto(
        uuid: '550e8400-e29b-41d4-a716-446655440000'
    );

    expect($dto)
        ->toBeInstanceOf(GetPreSaleActionRequestDto::class)
        ->and($dto->uuid)->toBe('550e8400-e29b-41d4-a716-446655440000');
});

test('get pre-sale action request dto can be created from array', function (): void {
    $dto = GetPreSaleActionRequestDto::from([
        'uuid' => '550e8400-e29b-41d4-a716-446655440001',
    ]);

    expect($dto)
        ->toBeInstanceOf(GetPreSaleActionRequestDto::class)
        ->and($dto->uuid)->toBe('550e8400-e29b-41d4-a716-446655440001');
});
