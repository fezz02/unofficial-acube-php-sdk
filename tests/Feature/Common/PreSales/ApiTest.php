<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\AcubeApi;
use Fezz\Acube\Sdk\Common\PreSales\Dto\GetPreSalesResponseDto;
use Fezz\Acube\Sdk\Common\PreSales\Dto\PreSaleDto;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function (): void {
});

test('can list pre sales', function (): void {
    $connector = AcubeApi::common();
    $preSalesApi = $connector->preSales();

    $mockData = [
        [
            'uuid' => 'presale-123',
            'created_at' => '2024-01-01T00:00:00Z',
            'valid_until' => '2024-12-31T23:59:59Z',
            'total_credit_purchased' => '1000.00',
            'current_credit_available' => '750.00',
            'current_credit_purchased' => '1000.00',
            'invoices_sent' => 10,
            'invoices_received' => 5,
        ],
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $requestDto = new Fezz\Acube\Sdk\Common\PreSales\Dto\GetPreSalesRequestDto(query: []);
    $response = $preSalesApi->list($requestDto);
    $dto = $response->dto();

    expect($dto)
        ->toBeInstanceOf(GetPreSalesResponseDto::class)
        ->and($dto->preSales)->toHaveCount(1)
        ->and($dto->preSales[0])->toBeInstanceOf(PreSaleDto::class)
        ->and($dto->preSales[0]->uuid)->toBe('presale-123')
        ->and($dto->preSales[0]->total_credit_purchased)->toBe('1000.00')
        ->and($dto->preSales[0]->invoices_sent)->toBe(10);
});

test('can list pre sales with query parameters', function (): void {
    $connector = AcubeApi::common();
    $preSalesApi = $connector->preSales();

    $mockClient = new MockClient([
        MockResponse::make([], 200),
    ]);

    $connector->withMockClient($mockClient);

    $requestDto = new Fezz\Acube\Sdk\Common\PreSales\Dto\GetPreSalesRequestDto(query: ['page' => 2]);
    $response = $preSalesApi->list($requestDto);
    $dto = $response->dto();

    expect($dto)
        ->toBeInstanceOf(GetPreSalesResponseDto::class)
        ->and($dto->preSales)->toHaveCount(0);
});

test('can get pre sale by uuid', function (): void {
    $connector = AcubeApi::common();
    $preSalesApi = $connector->preSales();

    $mockData = [
        'uuid' => 'presale-456',
        'created_at' => '2024-02-01T00:00:00Z',
        'valid_until' => '2025-01-31T23:59:59Z',
        'total_credit_purchased' => '2000.00',
        'current_credit_available' => '1500.00',
        'current_credit_purchased' => '2000.00',
        'invoices_sent' => 20,
        'invoices_received' => 15,
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $preSalesApi->get('presale-456');
    $dto = $response->dto();

    expect($dto)
        ->toBeInstanceOf(PreSaleDto::class)
        ->and($dto->uuid)->toBe('presale-456')
        ->and($dto->total_credit_purchased)->toBe('2000.00')
        ->and($dto->invoices_received)->toBe(15);
});

test('pre sale dto can be created from array', function (): void {
    $data = [
        'uuid' => 'presale-789',
        'created_at' => '2024-03-01T00:00:00Z',
        'valid_until' => '2025-02-28T23:59:59Z',
        'total_credit_purchased' => '3000.00',
        'current_credit_available' => '2500.00',
        'current_credit_purchased' => '3000.00',
        'invoices_sent' => 30,
        'invoices_received' => 25,
    ];

    $dto = PreSaleDto::from($data);

    expect($dto)
        ->toBeInstanceOf(PreSaleDto::class)
        ->and($dto->uuid)->toBe('presale-789')
        ->and($dto->current_credit_available)->toBe('2500.00')
        ->and($dto->invoices_sent)->toBe(30);
});

test('get pre sales response dto can handle empty array', function (): void {
    $dto = GetPreSalesResponseDto::from([]);

    expect($dto)
        ->toBeInstanceOf(GetPreSalesResponseDto::class)
        ->and($dto->preSales)->toHaveCount(0);
});

test('get pre sales response dto can be created from array', function (): void {
    $data = [
        [
            'uuid' => 'presale-1',
            'created_at' => '2024-01-01T00:00:00Z',
            'valid_until' => '2024-12-31T23:59:59Z',
            'total_credit_purchased' => '1000.00',
            'current_credit_available' => '750.00',
            'current_credit_purchased' => '1000.00',
            'invoices_sent' => 10,
            'invoices_received' => 5,
        ],
    ];

    $dto = GetPreSalesResponseDto::from($data);

    expect($dto)
        ->toBeInstanceOf(GetPreSalesResponseDto::class)
        ->and($dto->preSales)->toHaveCount(1)
        ->and($dto->preSales[0]->uuid)->toBe('presale-1');
});
