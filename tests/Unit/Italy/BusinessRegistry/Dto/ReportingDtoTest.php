<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\ReportingDto;

test('reporting dto can be created', function (): void {
    $dto = new ReportingDto(
        rejected_invoices_alert_schedule: ['daily' => true, 'time' => '09:00'],
    );

    expect($dto)
        ->toBeInstanceOf(ReportingDto::class)
        ->and($dto->rejected_invoices_alert_schedule)->toBeArray()
        ->and($dto->rejected_invoices_alert_schedule['daily'])->toBeTrue();
});

test('reporting dto can be created from array', function (): void {
    $dto = ReportingDto::from([
        'rejected_invoices_alert_schedule' => ['weekly' => true],
    ]);

    expect($dto)
        ->toBeInstanceOf(ReportingDto::class)
        ->and($dto->rejected_invoices_alert_schedule['weekly'])->toBeTrue();
});

