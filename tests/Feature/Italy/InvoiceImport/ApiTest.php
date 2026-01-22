<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\AcubeApi;
use Fezz\Acube\Sdk\Italy\InvoiceImport\Dto\CustomerInvoiceImportRequestDto;
use Fezz\Acube\Sdk\Italy\InvoiceImport\Dto\SupplierInvoiceImportRequestDto;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('can import customer invoice', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->invoiceImports();

    $dto = new CustomerInvoiceImportRequestDto(
        invoice: 'base64-encoded-xml-content'
    );

    $mockData = [
        'uuid' => 'imported-invoice-uuid-123',
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 201),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->importCustomer($dto);
    $responseDto = $response->dto();

    expect($responseDto)
        ->toBeInstanceOf(Fezz\Acube\Sdk\Italy\InvoiceImport\Dto\InvoiceImportResponseDto::class)
        ->and($responseDto->uuid)->toBe('imported-invoice-uuid-123');
});

test('can import supplier invoice', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->invoiceImports();

    $dto = new SupplierInvoiceImportRequestDto(
        invoice: 'base64-encoded-xml-content'
    );

    $mockData = [
        'uuid' => 'imported-invoice-uuid-456',
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 201),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->importSupplier($dto);
    $responseDto = $response->dto();

    expect($responseDto)
        ->toBeInstanceOf(Fezz\Acube\Sdk\Italy\InvoiceImport\Dto\InvoiceImportResponseDto::class)
        ->and($responseDto->uuid)->toBe('imported-invoice-uuid-456');
});
