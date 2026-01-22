<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\Receipt\Dto\ReceiptDto;
use Fezz\Acube\Sdk\Italy\Receipt\Requests\GetReceiptRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('resolveEndpoint returns correct path', function (): void {
    $request = new GetReceiptRequest('receipt-123');

    expect($request->resolveEndpoint())->toBe('/receipts/receipt-123');
});

test('createDtoFromResponse returns ReceiptDto', function (): void {
    $request = new GetReceiptRequest('receipt-123');

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
        ], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);
    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeInstanceOf(ReceiptDto::class)
        ->and($result->data['uuid'])->toBe('receipt-123')
        ->and($result->data['fiscal_id'])->toBe('FISCAL123')
        ->and($result->data['receipt_number'])->toBe('REC-001');
});

test('defaultHeaders returns correct headers', function (): void {
    $request = new GetReceiptRequest('receipt-123');

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');
    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers['Accept'])->toBe('application/json');
});
