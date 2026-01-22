<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\UpdateReportingRequestDto;

test('update reporting request dto can be created', function (): void {
    $dto = new UpdateReportingRequestDto(
        id: '12345678901',
        rejected_invoices_alert_schedule: ['daily' => true, 'time' => '09:00'],
    );

    expect($dto)
        ->toBeInstanceOf(UpdateReportingRequestDto::class)
        ->and($dto->id)->toBe('12345678901')
        ->and($dto->rejected_invoices_alert_schedule)->toBeArray();
});

test('update reporting request dto can be created from array', function (): void {
    $dto = UpdateReportingRequestDto::from([
        'id' => '98765432101',
        'rejected_invoices_alert_schedule' => ['weekly' => true],
    ]);

    expect($dto)
        ->toBeInstanceOf(UpdateReportingRequestDto::class)
        ->and($dto->rejected_invoices_alert_schedule['weekly'])->toBeTrue();
});

