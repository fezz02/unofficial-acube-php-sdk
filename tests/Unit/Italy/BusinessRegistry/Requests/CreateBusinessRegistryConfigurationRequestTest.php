<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\BusinessRegistryConfigurationDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\CreateBusinessRegistryConfigurationRequestDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\CreateBusinessRegistryConfigurationRequest;
use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new CreateBusinessRegistryConfigurationRequestDto(fiscal_id: '12345678901');
    $request = new CreateBusinessRegistryConfigurationRequest($dto);

    expect($request->resolveEndpoint())->toBe('/business-registry-configurations');
});

test('createDtoFromResponse returns BusinessRegistryConfigurationDto', function (): void {
    $dto = new CreateBusinessRegistryConfigurationRequestDto(fiscal_id: '12345678901');
    $request = new CreateBusinessRegistryConfigurationRequest($dto);

    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new MockClient([
        MockResponse::make([
            'fiscal_id' => '12345678901',
            'name' => 'Test Company',
        ], 201),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);
    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeInstanceOf(BusinessRegistryConfigurationDto::class)
        ->and($result->fiscal_id)->toBe('12345678901');
});

test('defaultBody filters out null values but preserves empty arrays', function (): void {
    $dto = new CreateBusinessRegistryConfigurationRequestDto(
        fiscal_id: '12345678901',
        name: 'Test Company',
        email: null,  // This should be filtered out
        api_configurations: [],  // This should be preserved
    );
    $request = new CreateBusinessRegistryConfigurationRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultBody');
    $body = $method->invoke($request);

    expect($body)->toBeArray()
        ->and($body)->toHaveKey('fiscal_id')
        ->and($body)->toHaveKey('name')
        ->and($body)->toHaveKey('api_configurations')
        ->and($body['api_configurations'])->toBe([])
        ->and($body)->not->toHaveKey('email');
});

