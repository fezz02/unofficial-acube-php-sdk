<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\Receipt\Api;
use Fezz\Acube\Sdk\Italy\Receipt\Dto\CreateReceiptRequestDto;
use Fezz\Acube\Sdk\Italy\Receipt\Dto\GetReceiptsRequestDto;
use Fezz\Acube\Sdk\Italy\Receipt\Dto\ReturnReceiptRequestDto;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function (): void {
});

test('list receipts', function (): void {
    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $api = new Api($connector);

    $mockClient = new MockClient([
        MockResponse::make([
            [
                'id' => 'receipt-123',
                'document_number' => 'DOC001',
            ],
        ], 200),
    ]);

    $connector->withMockClient($mockClient);

    $dto = new GetReceiptsRequestDto([]);
    $response = $api->list($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('create receipt', function (): void {
    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $api = new Api($connector);

    $mockClient = new MockClient([
        MockResponse::make([
            'id' => 'receipt-123',
            'document_number' => 'DOC001',
        ], 201),
    ]);

    $connector->withMockClient($mockClient);

    $dto = new CreateReceiptRequestDto([
        'document_number' => 'DOC001',
        'document_date' => '2024-01-01',
    ]);
    $response = $api->create($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(201);
});

test('get receipt by id', function (): void {
    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $api = new Api($connector);

    $mockClient = new MockClient([
        MockResponse::make([
            'id' => 'receipt-123',
            'document_number' => 'DOC001',
        ], 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->get('receipt-123');

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('get receipt details', function (): void {
    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $api = new Api($connector);

    $mockClient = new MockClient([
        MockResponse::make([
            'id' => 'receipt-123',
            'details' => 'Receipt details',
        ], 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->getDetails('receipt-123');

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('return receipt', function (): void {
    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $api = new Api($connector);

    $mockClient = new MockClient([
        MockResponse::make([
            'id' => 'return-receipt-123',
            'document_number' => 'RET001',
        ], 201),
    ]);

    $connector->withMockClient($mockClient);

    $dto = new ReturnReceiptRequestDto('receipt-123', [
        'items' => [],
    ]);
    $response = $api->returnReceipt($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(201);
});

test('delete receipt', function (): void {
    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $api = new Api($connector);

    $mockClient = new MockClient([
        MockResponse::make('', 204),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->delete('receipt-123');

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(204);
});
