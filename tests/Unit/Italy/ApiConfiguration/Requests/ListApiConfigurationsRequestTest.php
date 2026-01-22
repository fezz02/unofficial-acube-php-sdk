<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\ApiConfiguration\Dto\ApiConfigurationDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\ApiConfiguration\Dto\GetApiConfigurationsRequestDto;
use Fezz\Acube\Sdk\Italy\ApiConfiguration\Requests\ListApiConfigurationsRequest;
use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('list api configurations builds correct endpoint and query', function (): void {
    $dto = new GetApiConfigurationsRequestDto(
        business_registry_configurations_fiscal_id: 'IT12345678901',
        business_registry_configurations_fiscal_id_array: ['IT12345678901', 'IT98765432109'],
        target_url: 'https://example.com/webhook',
        page: 2,
        itemsPerPage: 50,
    );

    $request = new ListApiConfigurationsRequest($dto);

    expect($request->resolveEndpoint())->toBe('/api-configurations');

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultQuery');
    /** @var array<string, mixed> $query */
    $query = $method->invoke($request);

    expect($query)
        ->toHaveKey('business_registry_configurations.fiscal_id', 'IT12345678901')
        ->toHaveKey('business_registry_configurations.fiscal_id[]', ['IT12345678901', 'IT98765432109'])
        ->toHaveKey('target_url', 'https://example.com/webhook')
        ->toHaveKey('page', 2)
        ->toHaveKey('itemsPerPage', 50);
});

test('list api configurations createDtoFromResponse returns array of ApiConfigurationDto', function (): void {
    $dto = new GetApiConfigurationsRequestDto();
    $request = new ListApiConfigurationsRequest($dto);

    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new MockClient([
        MockResponse::make([
            [
                'uuid' => 'cfg-1',
                'event' => 'supplier-invoice',
                'target_url' => 'https://example.com/webhook',
                'authentication_type' => 'header',
                'authentication_key' => null,
                'authentication_token' => null,
                'business_registry_configurations' => [],
            ],
        ], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);
    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeArray()
        ->and($result[0])->toBeInstanceOf(ApiConfigurationDto::class)
        ->and($result[0]->uuid)->toBe('cfg-1');
});

test('list api configurations defaultHeaders return json accept', function (): void {
    $dto = new GetApiConfigurationsRequestDto();
    $request = new ListApiConfigurationsRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');
    /** @var array<string, string> $headers */
    $headers = $method->invoke($request);

    expect($headers)
        ->toHaveKey('Accept', 'application/json');
});

