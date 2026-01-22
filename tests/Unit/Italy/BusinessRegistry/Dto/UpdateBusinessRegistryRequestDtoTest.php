<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\UpdateBusinessRegistryRequestDto;

test('update business registry request dto can be created', function (): void {
    $dto = new UpdateBusinessRegistryRequestDto(
        head_office_address_street: 'Via Test',
        head_office_address_zip_code: '00100',
        head_office_address_city: 'Roma',
        head_office_address_country: 'IT',
        business_name: 'Updated Company',
    );

    expect($dto)
        ->toBeInstanceOf(UpdateBusinessRegistryRequestDto::class)
        ->and($dto->head_office_address_street)->toBe('Via Test')
        ->and($dto->business_name)->toBe('Updated Company');
});

test('update business registry request dto can be created from array', function (): void {
    $dto = UpdateBusinessRegistryRequestDto::from([
        'head_office_address_street' => 'Via Updated',
        'head_office_address_zip_code' => '20100',
        'head_office_address_city' => 'Milano',
        'head_office_address_country' => 'IT',
    ]);

    expect($dto)
        ->toBeInstanceOf(UpdateBusinessRegistryRequestDto::class)
        ->and($dto->head_office_address_city)->toBe('Milano');
});

