<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\AppointSpidRequestDto;

test('appoint spid request dto can be created', function (): void {
    $dto = new AppointSpidRequestDto(
        id: '12345678901',
        appointee_fiscal_id: 'A-CUBE',
        appointing_person_data_fiscal_code: 'RSSMRA80A01H501U',
        appointing_person_data_name: 'Mario',
        appointing_person_data_surname: 'Rossi',
        appointing_person_data_residence: 'Roma',
        appointing_person_data_otp_cell_phone: '+3912345678',
        appointing_person_data_email: 'mario.rossi@example.com',
    );

    expect($dto)
        ->toBeInstanceOf(AppointSpidRequestDto::class)
        ->and($dto->id)->toBe('12345678901')
        ->and($dto->appointing_person_data_name)->toBe('Mario');
});

test('appoint spid request dto can be created from array', function (): void {
    $dto = AppointSpidRequestDto::from([
        'id' => '98765432101',
        'appointee_fiscal_id' => 'A-CUBE',
        'appointing_person_data_fiscal_code' => 'RSSMRA80A01H501U',
        'appointing_person_data_name' => 'Luigi',
        'appointing_person_data_surname' => 'Verdi',
        'appointing_person_data_residence' => 'Milano',
        'appointing_person_data_otp_cell_phone' => '+3998765432',
        'appointing_person_data_email' => 'luigi.verdi@example.com',
    ]);

    expect($dto)
        ->toBeInstanceOf(AppointSpidRequestDto::class)
        ->and($dto->appointing_person_data_surname)->toBe('Verdi');
});

