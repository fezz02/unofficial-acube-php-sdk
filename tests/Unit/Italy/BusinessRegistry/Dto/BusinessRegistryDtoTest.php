<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\BusinessRegistryDto;

test('business registry dto can be created', function (): void {
    $dto = new BusinessRegistryDto(
        uuid: '550e8400-e29b-41d4-a716-446655440000',
        head_office_address_street: 'Via Test',
        head_office_address_zip_code: '00100',
        head_office_address_city: 'Roma',
        head_office_address_country: 'IT',
        business_name: 'Test Company',
    );

    expect($dto)
        ->toBeInstanceOf(BusinessRegistryDto::class)
        ->and($dto->uuid)->toBe('550e8400-e29b-41d4-a716-446655440000')
        ->and($dto->head_office_address_street)->toBe('Via Test')
        ->and($dto->business_name)->toBe('Test Company');
});

test('business registry dto can be created from array', function (): void {
    $dto = BusinessRegistryDto::from([
        'uuid' => '550e8400-e29b-41d4-a716-446655440001',
        'head_office_address_street' => 'Via Test 2',
        'head_office_address_zip_code' => '20100',
        'head_office_address_city' => 'Milano',
        'head_office_address_country' => 'IT',
    ]);

    expect($dto)
        ->toBeInstanceOf(BusinessRegistryDto::class)
        ->and($dto->uuid)->toBe('550e8400-e29b-41d4-a716-446655440001')
        ->and($dto->head_office_address_city)->toBe('Milano');
});

