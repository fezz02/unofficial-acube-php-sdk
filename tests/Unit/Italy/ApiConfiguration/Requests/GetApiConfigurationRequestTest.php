<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\ApiConfiguration\Dto\ApiConfigurationDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\ApiConfiguration\Requests\GetApiConfigurationRequest;
use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('get api configuration resolveEndpoint returns correct path', function (): void {
    $request = new GetApiConfigurationRequest('cfg-123');

    expect($request->resolveEndpoint())->toBe('/api-configurations/cfg-123');
});

test('get api configuration createDtoFromResponse returns ApiConfigurationDto', function (): void {
    $request = new GetApiConfigurationRequest('cfg-123');

    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new MockClient([
        MockResponse::make([
            'uuid' => 'cfg-123',
            'event' => 'supplier-invoice',
            'target_url' => 'https://example.com/webhook',
            'authentication_type' => 'header',
            'authentication_key' => null,
            'authentication_token' => null,
            'business_registry_configurations' => [],
        ], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);
    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeInstanceOf(ApiConfigurationDto::class)
        ->and($result->uuid)->toBe('cfg-123');
});

test('get api configuration defaultHeaders return json accept', function (): void {
    $request = new GetApiConfigurationRequest('cfg-123');

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');
    /** @var array<string, string> $headers */
    $headers = $method->invoke($request);

    expect($headers)
        ->toHaveKey('Accept', 'application/json');
});




