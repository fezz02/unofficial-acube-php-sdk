<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\Receipt\Dto\CreateReceiptRequestDto;
use Fezz\Acube\Sdk\Italy\Receipt\Dto\ReceiptDto;
use Fezz\Acube\Sdk\Italy\Receipt\Requests\CreateReceiptRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new CreateReceiptRequestDto(receipt: []);
    $request = new CreateReceiptRequest($dto);

    expect($request->resolveEndpoint())->toBe('/receipts');
});

test('createDtoFromResponse returns ReceiptDto', function (): void {
    $dto = new CreateReceiptRequestDto(receipt: ['total_amount' => 100.00]);
    $request = new CreateReceiptRequest($dto);

    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new MockClient([
        MockResponse::make([
            'uuid' => 'receipt-123',
            'fiscal_id' => 'FISCAL123',
            'receipt_number' => 'REC-001',
            'receipt_date' => '2024-01-01',
            'total_amount' => 100.00,
            'currency' => 'EUR',
            'status' => 'ISSUED',
            'created_at' => '2024-01-01T10:00:00Z',
            'updated_at' => '2024-01-01T10:00:00Z',
        ], 201),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);
    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeInstanceOf(ReceiptDto::class)
        ->and($result->data['uuid'])->toBe('receipt-123');
});

test('defaultBody returns receipt data from DTO', function (): void {
    $receiptData = ['total_amount' => 100.00, 'currency' => 'EUR'];
    $dto = new CreateReceiptRequestDto(receipt: $receiptData);
    $request = new CreateReceiptRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultBody');
    $body = $method->invoke($request);

    expect($body)->toBeArray()
        ->and($body)->toBe($receiptData);
});

test('defaultHeaders returns correct headers', function (): void {
    $dto = new CreateReceiptRequestDto(receipt: []);
    $request = new CreateReceiptRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');
    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers['Accept'])->toBe('application/json')
        ->and($headers)->toHaveKey('Content-Type')
        ->and($headers['Content-Type'])->toBe('application/json');
});
