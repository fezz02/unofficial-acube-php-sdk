<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\GetReportingRequestDto;

test('get reporting request dto can be created', function (): void {
    $dto = new GetReportingRequestDto(
        id: '12345678901'
    );

    expect($dto)
        ->toBeInstanceOf(GetReportingRequestDto::class)
        ->and($dto->id)->toBe('12345678901');
});

test('get reporting request dto can be created from array', function (): void {
    $dto = GetReportingRequestDto::from([
        'id' => '98765432101',
    ]);

    expect($dto)
        ->toBeInstanceOf(GetReportingRequestDto::class)
        ->and($dto->id)->toBe('98765432101');
});

