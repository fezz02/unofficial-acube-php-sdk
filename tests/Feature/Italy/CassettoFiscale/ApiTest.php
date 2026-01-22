<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\AcubeApi;
use Fezz\Acube\Sdk\Italy\CassettoFiscale\Dto\CreateInvoiceDownloadJobRequestDto;
use Fezz\Acube\Sdk\Italy\CassettoFiscale\Dto\ScheduleInvoiceDownloadRequestDto;
use Fezz\Acube\Sdk\Italy\CassettoFiscale\Dto\UpdateScheduledInvoiceDownloadRequestDto;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('can schedule invoice download', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->cassettoFiscale();

    $dto = new ScheduleInvoiceDownloadRequestDto(
        download_archive: false
    );

    $mockData = [
        'enabled' => true,
        'valid_until' => '2025-12-31T00:00:00Z',
        'auto_renew' => true,
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->schedule('IT12345678901', $dto);
    $responseDto = $response->dto();

    expect($responseDto)
        ->toBeInstanceOf(Fezz\Acube\Sdk\Italy\CassettoFiscale\Dto\ScheduledInvoiceDownloadDto::class)
        ->and($responseDto->enabled)->toBeTrue()
        ->and($responseDto->auto_renew)->toBeTrue();
});

test('can get scheduled invoice download', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->cassettoFiscale();

    $mockData = [
        'enabled' => true,
        'valid_until' => '2025-12-31T00:00:00Z',
        'auto_renew' => false,
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->getSchedule('IT12345678901');
    $responseDto = $response->dto();

    expect($responseDto)
        ->toBeInstanceOf(Fezz\Acube\Sdk\Italy\CassettoFiscale\Dto\ScheduledInvoiceDownloadDto::class)
        ->and($responseDto->enabled)->toBeTrue();
});

test('can delete scheduled invoice download', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->cassettoFiscale();

    $mockClient = new MockClient([
        MockResponse::make([], 204),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->deleteSchedule('IT12345678901');

    expect($response->status())->toBe(204);
});

test('can update scheduled invoice download', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->cassettoFiscale();

    $dto = new UpdateScheduledInvoiceDownloadRequestDto(
        auto_renew: true
    );

    $mockData = [
        'enabled' => true,
        'valid_until' => '2025-12-31T00:00:00Z',
        'auto_renew' => true,
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->updateSchedule('IT12345678901', $dto);
    $responseDto = $response->dto();

    expect($responseDto)
        ->toBeInstanceOf(Fezz\Acube\Sdk\Italy\CassettoFiscale\Dto\ScheduledInvoiceDownloadDto::class)
        ->and($responseDto->auto_renew)->toBeTrue();
});

test('can create invoice download job', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->cassettoFiscale();

    $dto = new CreateInvoiceDownloadJobRequestDto(
        from_date: '2024-01-01',
        to_date: '2024-01-31',
        fiscal_id: 'IT12345678901'
    );

    $mockData = [
        'uuid' => 'job-uuid-123',
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 201),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->createJob($dto);
    $responseDto = $response->dto();

    expect($responseDto)
        ->toBeInstanceOf(Fezz\Acube\Sdk\Italy\CassettoFiscale\Dto\CreateInvoiceDownloadJobResponseDto::class)
        ->and($responseDto->uuid)->toBe('job-uuid-123');
});
