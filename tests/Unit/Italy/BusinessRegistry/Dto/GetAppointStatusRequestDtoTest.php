<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\GetAppointStatusRequestDto;

test('get appoint status request dto can be created', function (): void {
    $dto = new GetAppointStatusRequestDto(
        id: '12345678901'
    );

    expect($dto)
        ->toBeInstanceOf(GetAppointStatusRequestDto::class)
        ->and($dto->id)->toBe('12345678901');
});

test('get appoint status request dto can be created from array', function (): void {
    $dto = GetAppointStatusRequestDto::from([
        'id' => '98765432101',
    ]);

    expect($dto)
        ->toBeInstanceOf(GetAppointStatusRequestDto::class)
        ->and($dto->id)->toBe('98765432101');
});

