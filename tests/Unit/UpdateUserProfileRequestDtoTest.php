<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Common\User\Dto\UpdateUserProfileRequestDto;

test('update user profile request dto can be created', function (): void {
    $dto = new UpdateUserProfileRequestDto(
        fullname: 'Updated Profile',
        invoicing_vat_number: 'VAT123',
        invoicing_fiscal_id: 'FISCAL123',
        invoicing_address: '123 Main St',
        invoicing_city: 'City',
        invoicing_province: 'Province',
        invoicing_cap: '12345',
        invoicing_name: 'Invoice Name',
        invoicing_country: 'IT',
        invoicing_sdi_recipient_code: 'SDI123',
        invoicing_sdi_pec: 'pec@example.com'
    );

    expect($dto)
        ->toBeInstanceOf(UpdateUserProfileRequestDto::class)
        ->and($dto->fullname)->toBe('Updated Profile')
        ->and($dto->invoicing_vat_number)->toBe('VAT123');
});

test('update user profile request dto can handle all null values', function (): void {
    $dto = new UpdateUserProfileRequestDto;

    expect($dto)
        ->toBeInstanceOf(UpdateUserProfileRequestDto::class)
        ->and($dto->fullname)->toBeNull()
        ->and($dto->invoicing_vat_number)->toBeNull();
});

test('update user profile request dto can be created from array', function (): void {
    $dto = UpdateUserProfileRequestDto::from([
        'fullname' => 'From Array',
        'invoicing_vat_number' => 'VAT456',
        'invoicing_fiscal_id' => null,
        'invoicing_address' => null,
        'invoicing_city' => null,
        'invoicing_province' => null,
        'invoicing_cap' => null,
        'invoicing_name' => null,
        'invoicing_country' => null,
        'invoicing_sdi_recipient_code' => null,
        'invoicing_sdi_pec' => null,
    ]);

    expect($dto)
        ->toBeInstanceOf(UpdateUserProfileRequestDto::class)
        ->and($dto->fullname)->toBe('From Array')
        ->and($dto->invoicing_vat_number)->toBe('VAT456');
});
