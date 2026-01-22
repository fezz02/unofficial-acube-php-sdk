<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\Receipt\Dto\ReceiptDto;
use Fezz\Acube\Sdk\Italy\Receipt\Dto\ReturnReceiptRequestDto;
use Fezz\Acube\Sdk\Italy\Receipt\Requests\ReturnReceiptRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new ReturnReceiptRequestDto(id: 'receipt-123', receipt: []);
    $request = new ReturnReceiptRequest($dto);

    expect($request->resolveEndpoint())->toBe('/receipts/receipt-123/return');
});

test('createDtoFromResponse returns ReceiptDto', function (): void {
    $dto = new ReturnReceiptRequestDto(id: 'receipt-123', receipt: ['items' => []]);
    $request = new ReturnReceiptRequest($dto);

    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new MockClient([
        MockResponse::make([
            'uuid' => 'return-receipt-123',
            'fiscal_id' => 'FISCAL123',
            'receipt_number' => 'RET-001',
            'receipt_date' => '2024-01-01',
            'total_amount' => 50.00,
            'currency' => 'EUR',
            'status' => 'RETURNED',
            'created_at' => '2024-01-01T10:00:00Z',
            'updated_at' => '2024-01-01T10:00:00Z',
        ], 201),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);
    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeInstanceOf(ReceiptDto::class)
        ->and($result->data['uuid'])->toBe('return-receipt-123');
});

test('defaultBody returns receipt data from DTO', function (): void {
    $receiptData = ['items' => [['id' => 1, 'quantity' => 1]]];
    $dto = new ReturnReceiptRequestDto(id: 'receipt-123', receipt: $receiptData);
    $request = new ReturnReceiptRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultBody');
    $body = $method->invoke($request);

    expect($body)->toBeArray()
        ->and($body)->toBe($receiptData);
});

test('defaultHeaders returns correct headers', function (): void {
    $dto = new ReturnReceiptRequestDto(id: 'receipt-123', receipt: []);
    $request = new ReturnReceiptRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');
    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers['Accept'])->toBe('application/json')
        ->and($headers)->toHaveKey('Content-Type')
        ->and($headers['Content-Type'])->toBe('application/json');
});
