<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\AcubeApi;
use Fezz\Acube\Sdk\Italy\InvoiceExtract\Dto\CreateInvoiceExtractJobRequestDto;
use Fezz\Acube\Sdk\Italy\InvoiceExtract\Dto\GetInvoiceExtractJobRequestDto;
use Fezz\Acube\Sdk\Italy\InvoiceExtract\Dto\GetInvoiceExtractRawRequestDto;
use Fezz\Acube\Sdk\Italy\InvoiceExtract\Dto\GetInvoiceExtractResultRequestDto;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('can create invoice extract job', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->invoiceExtract();

    $dto = new CreateInvoiceExtractJobRequestDto(
        file_path: '/tmp/test-invoice.pdf',
        default_vat_rate: 22.0,
        convert_amounts: true
    );

    $mockData = [
        'uuid' => 'extract-job-uuid-123',
        'status' => 'pending',
        'created_at' => '2024-01-01T00:00:00Z',
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 201),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->createJob($dto);
    $responseDto = $response->dto();

    expect($responseDto)
        ->toBeInstanceOf(Fezz\Acube\Sdk\Italy\InvoiceExtract\Dto\InvoiceExtractJobDto::class)
        ->and($responseDto->uuid)->toBe('extract-job-uuid-123');
});

test('can get invoice extract job', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->invoiceExtract();

    $dto = new GetInvoiceExtractJobRequestDto(uuid: 'extract-job-uuid-123');

    $mockData = [
        'uuid' => 'extract-job-uuid-123',
        'status' => 'completed',
        'created_at' => '2024-01-01T00:00:00Z',
        'updated_at' => '2024-01-01T00:05:00Z',
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->getJob($dto);
    $responseDto = $response->dto();

    expect($responseDto)
        ->toBeInstanceOf(Fezz\Acube\Sdk\Italy\InvoiceExtract\Dto\InvoiceExtractJobDto::class)
        ->and($responseDto->uuid)->toBe('extract-job-uuid-123');
});

test('can get invoice extract result', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->invoiceExtract();

    $dto = new GetInvoiceExtractResultRequestDto(
        uuid: 'extract-job-uuid-123',
        format: 'json'
    );

    $mockData = [
        'fattura_elettronica_header' => [],
        'fattura_elettronica_body' => [],
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->getResult($dto);

    expect($response->status())->toBe(200)
        ->and($response->json())->toBeArray();
});

test('can get raw invoice extract data', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->invoiceExtract();

    $dto = new GetInvoiceExtractRawRequestDto('job-uuid-123');

    $mockData = [
        'extracted_data' => [
            'invoice_number' => 'INV-001',
            'date' => '2024-01-01',
        ],
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->getRaw($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});
