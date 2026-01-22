<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\AcubeApi;
use Fezz\Acube\Sdk\Italy\ApiConfiguration\Dto\CreateApiConfigurationRequestDto;
use Fezz\Acube\Sdk\Italy\ApiConfiguration\Dto\GetApiConfigurationsRequestDto;
use Fezz\Acube\Sdk\Italy\ApiConfiguration\Dto\UpdateApiConfigurationRequestDto;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function (): void {
});

test('can list api configurations', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->apiConfigurations();

    $dto = new GetApiConfigurationsRequestDto(
        business_registry_configurations_fiscal_id: 'IT12345678901',
        page: 1,
    );

    $mockData = [
        [
            'uuid' => 'cfg-1',
            'event' => 'supplier-invoice',
            'target_url' => 'https://example.com/webhook',
            'authentication_type' => 'header',
            'authentication_key' => null,
            'authentication_token' => null,
            'business_registry_configurations' => [],
        ],
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $api->list($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('can get api configuration', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->apiConfigurations();

    $mockData = [
        'uuid' => 'cfg-1',
        'event' => 'supplier-invoice',
        'target_url' => 'https://example.com/webhook',
        'authentication_type' => 'header',
        'authentication_key' => null,
        'authentication_token' => null,
        'business_registry_configurations' => [],
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $api->get('cfg-1');

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('can create api configuration', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->apiConfigurations();

    $dto = new CreateApiConfigurationRequestDto(
        event: 'supplier-invoice',
        target_url: 'https://example.com/webhook',
        authentication_type: 'header',
    );

    $mockData = [
        'uuid' => 'cfg-1',
        'event' => 'supplier-invoice',
        'target_url' => 'https://example.com/webhook',
        'authentication_type' => 'header',
        'authentication_key' => null,
        'authentication_token' => null,
        'business_registry_configurations' => [],
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 201),
    ]);
    $connector->withMockClient($mockClient);

    $response = $api->create($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(201);
});

test('can update api configuration', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->apiConfigurations();

    $dto = new UpdateApiConfigurationRequestDto(
        event: 'supplier-invoice',
        target_url: 'https://example.com/updated',
        authentication_type: 'header',
        authentication_key: 'X-API-KEY',
        authentication_token: 'secret',
        business_registry_configurations: [],
    );

    $mockData = [
        'uuid' => 'cfg-1',
        'event' => 'supplier-invoice',
        'target_url' => 'https://example.com/updated',
        'authentication_type' => 'header',
        'authentication_key' => 'X-API-KEY',
        'authentication_token' => 'secret',
        'business_registry_configurations' => [],
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $api->update('cfg-1', $dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('can delete api configuration', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->apiConfigurations();

    $mockClient = new MockClient([
        MockResponse::make('', 204),
    ]);
    $connector->withMockClient($mockClient);

    $response = $api->delete('cfg-1');

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(204);
});




