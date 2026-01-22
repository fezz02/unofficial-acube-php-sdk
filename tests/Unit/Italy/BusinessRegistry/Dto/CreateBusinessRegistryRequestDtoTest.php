<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\CreateBusinessRegistryRequestDto;

test('create business registry request dto can be created', function (): void {
    $dto = new CreateBusinessRegistryRequestDto(
        head_office_address_street: 'Via Test',
        head_office_address_zip_code: '00100',
        head_office_address_city: 'Roma',
        head_office_address_country: 'IT',
        business_name: 'Test Company',
    );

    expect($dto)
        ->toBeInstanceOf(CreateBusinessRegistryRequestDto::class)
        ->and($dto->head_office_address_street)->toBe('Via Test')
        ->and($dto->business_name)->toBe('Test Company');
});

test('create business registry request dto can be created from array', function (): void {
    $dto = CreateBusinessRegistryRequestDto::from([
        'head_office_address_street' => 'Via Test 2',
        'head_office_address_zip_code' => '20100',
        'head_office_address_city' => 'Milano',
        'head_office_address_country' => 'IT',
    ]);

    expect($dto)
        ->toBeInstanceOf(CreateBusinessRegistryRequestDto::class)
        ->and($dto->head_office_address_city)->toBe('Milano');
});

