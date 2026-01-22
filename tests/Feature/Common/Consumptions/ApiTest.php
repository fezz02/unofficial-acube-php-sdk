<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\AcubeApi;
use Fezz\Acube\Sdk\Common\Consumptions\Dto\GetConsumptionsRequestDto;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('can list consumptions', function (): void {
    $connector = AcubeApi::common();
    $api = $connector->consumptions();

    $dto = new GetConsumptionsRequestDto(
        query: [
            'year' => 2024,
            'month' => 1,
            'page' => 1,
        ]
    );

    $mockData = [
        [
            'uuid' => 'consumption-uuid-123',
            'month' => 1,
            'year' => 2024,
            'total' => '100.00',
            'invoices_sent' => 10,
            'invoices_received' => 5,
        ],
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->list($dto);
    $responseDto = $response->dto();

    expect($responseDto)
        ->toBeInstanceOf(Fezz\Acube\Sdk\Common\Consumptions\Dto\GetConsumptionsResponseDto::class)
        ->and($responseDto->items)->toHaveCount(1)
        ->and($responseDto->items[0]->uuid)->toBe('consumption-uuid-123')
        ->and($responseDto->items[0]->month)->toBe(1)
        ->and($responseDto->items[0]->year)->toBe(2024);
});

test('can get consumption by uuid', function (): void {
    $connector = AcubeApi::common();
    $api = $connector->consumptions();

    $mockData = [
        'uuid' => 'consumption-uuid-123',
        'month' => 1,
        'year' => 2024,
        'total' => '100.00',
        'invoices_sent' => 10,
        'invoices_received' => 5,
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->get('consumption-uuid-123');
    $responseDto = $response->dto();

    expect($responseDto)
        ->toBeInstanceOf(Fezz\Acube\Sdk\Common\Consumptions\Dto\ConsumptionDto::class)
        ->and($responseDto->uuid)->toBe('consumption-uuid-123')
        ->and($responseDto->month)->toBe(1)
        ->and($responseDto->year)->toBe(2024)
        ->and($responseDto->total)->toBe('100.00')
        ->and($responseDto->invoices_sent)->toBe(10)
        ->and($responseDto->invoices_received)->toBe(5);
});

test('can handle empty consumptions list', function (): void {
    $connector = AcubeApi::common();
    $api = $connector->consumptions();

    $dto = new GetConsumptionsRequestDto(query: []);

    $mockClient = new MockClient([
        MockResponse::make([], 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->list($dto);
    $responseDto = $response->dto();

    expect($responseDto)
        ->toBeInstanceOf(Fezz\Acube\Sdk\Common\Consumptions\Dto\GetConsumptionsResponseDto::class)
        ->and($responseDto->items)->toBe([])
        ->and($responseDto->items)->toHaveCount(0);
});
