<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\InvoiceTransfer\Api;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\InvoiceTransfer\Dto\DownloadInvoiceTransferRequestDto;
use Fezz\Acube\Sdk\Italy\InvoiceTransfer\Dto\GetInvoiceTransferRequestDto;
use Fezz\Acube\Sdk\Italy\InvoiceTransfer\Dto\GetInvoiceTransfersRequestDto;
use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function (): void {
});

test('list invoice transfers', function (): void {
    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $api = new Api($connector);

    $mockClient = new MockClient([
        MockResponse::make([
            [
                'id' => 'transfer-123',
                'created_at' => '2024-01-01T00:00:00Z',
            ],
        ], 200),
    ]);

    $connector->withMockClient($mockClient);

    $dto = new GetInvoiceTransfersRequestDto([]);
    $response = $api->list($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('get invoice transfer', function (): void {
    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $api = new Api($connector);

    $mockClient = new MockClient([
        MockResponse::make([
            'id' => 'transfer-123',
            'created_at' => '2024-01-01T00:00:00Z',
        ], 200),
    ]);

    $connector->withMockClient($mockClient);

    $dto = new GetInvoiceTransferRequestDto('transfer-123');
    $response = $api->get($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('download invoice transfer', function (): void {
    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $api = new Api($connector);

    $mockClient = new MockClient([
        MockResponse::make('PDF content here', 200, ['Content-Type' => 'application/pdf']),
    ]);

    $connector->withMockClient($mockClient);

    $dto = new DownloadInvoiceTransferRequestDto('transfer-123');
    $response = $api->download($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200)
        ->and($response->body())->toBe('PDF content here');
});
