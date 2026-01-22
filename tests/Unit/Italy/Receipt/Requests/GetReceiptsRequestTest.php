<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\Receipt\Dto\GetReceiptsRequestDto;
use Fezz\Acube\Sdk\Italy\Receipt\Dto\ReceiptDto;
use Fezz\Acube\Sdk\Italy\Receipt\Requests\GetReceiptsRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new GetReceiptsRequestDto(query: []);
    $request = new GetReceiptsRequest($dto);

    expect($request->resolveEndpoint())->toBe('/receipts');
});

test('createDtoFromResponse returns array of ReceiptDto', function (): void {
    $dto = new GetReceiptsRequestDto(query: []);
    $request = new GetReceiptsRequest($dto);

    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new MockClient([
        MockResponse::make([
            [
                'uuid' => 'receipt-1',
                'fiscal_id' => 'FISCAL123',
                'receipt_number' => 'REC-001',
                'receipt_date' => '2024-01-01',
                'total_amount' => 100.00,
                'currency' => 'EUR',
                'status' => 'ISSUED',
                'created_at' => '2024-01-01T10:00:00Z',
                'updated_at' => '2024-01-01T10:00:00Z',
            ],
            [
                'uuid' => 'receipt-2',
                'fiscal_id' => 'FISCAL456',
                'receipt_number' => 'REC-002',
                'receipt_date' => '2024-01-02',
                'total_amount' => 200.00,
                'currency' => 'EUR',
                'status' => 'ISSUED',
                'created_at' => '2024-01-02T10:00:00Z',
                'updated_at' => '2024-01-02T10:00:00Z',
            ],
        ], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);
    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeArray()
        ->and($result)->toHaveCount(2)
        ->and($result[0])->toBeInstanceOf(ReceiptDto::class)
        ->and($result[1])->toBeInstanceOf(ReceiptDto::class)
        ->and($result[0]->data['uuid'])->toBe('receipt-1')
        ->and($result[1]->data['uuid'])->toBe('receipt-2');
});

test('defaultQuery returns query parameters from DTO', function (): void {
    $query = ['status' => 'ISSUED', 'limit' => 10];
    $dto = new GetReceiptsRequestDto(query: $query);
    $request = new GetReceiptsRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultQuery');
    $result = $method->invoke($request);

    expect($result)->toBeArray()
        ->and($result)->toBe($query)
        ->and($result['status'])->toBe('ISSUED')
        ->and($result['limit'])->toBe(10);
});

test('defaultHeaders returns correct headers', function (): void {
    $dto = new GetReceiptsRequestDto(query: []);
    $request = new GetReceiptsRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');
    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers['Accept'])->toBe('application/json');
});
