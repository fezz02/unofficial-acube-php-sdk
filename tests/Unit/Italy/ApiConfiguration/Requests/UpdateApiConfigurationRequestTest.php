<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\ApiConfiguration\Dto\ApiConfigurationDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\ApiConfiguration\Dto\UpdateApiConfigurationRequestDto;
use Fezz\Acube\Sdk\Italy\ApiConfiguration\Requests\UpdateApiConfigurationRequest;
use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('update api configuration uses correct endpoint and headers', function (): void {
    $dto = new UpdateApiConfigurationRequestDto(
        event: 'supplier-invoice',
        target_url: 'https://example.com/webhook',
        authentication_type: 'header',
        authentication_key: 'X-API-KEY',
        authentication_token: 'secret',
        business_registry_configurations: [],
    );

    $request = new UpdateApiConfigurationRequest('uuid-123', $dto);

    expect($request->resolveEndpoint())->toBe('/api-configurations/uuid-123');

    $reflection = new ReflectionClass($request);
    $headersMethod = $reflection->getMethod('defaultHeaders');
    /** @var array<string, string> $headers */
    $headers = $headersMethod->invoke($request);

    expect($headers)
        ->toHaveKey('Content-Type', 'application/json')
        ->toHaveKey('Accept', 'application/json');
});

test('update api configuration defaultBody filters null values', function (): void {
    $dto = new UpdateApiConfigurationRequestDto(
        event: 'supplier-invoice',
        target_url: 'https://example.com/webhook',
        authentication_type: 'header',
        authentication_key: null,
        authentication_token: null,
        business_registry_configurations: [],
    );

    $request = new UpdateApiConfigurationRequest('uuid-123', $dto);

    $reflection = new ReflectionClass($request);
    $bodyMethod = $reflection->getMethod('defaultBody');
    /** @var array<string, mixed> $body */
    $body = $bodyMethod->invoke($request);

    expect($body)
        ->toHaveKey('event', 'supplier-invoice')
        ->toHaveKey('target_url', 'https://example.com/webhook')
        ->not->toHaveKey('authentication_key')
        ->not->toHaveKey('authentication_token');
});

test('update api configuration createDtoFromResponse returns ApiConfigurationDto', function (): void {
    $dto = new UpdateApiConfigurationRequestDto(
        event: 'supplier-invoice',
        target_url: 'https://example.com/webhook',
        authentication_type: 'header',
        authentication_key: 'X-API-KEY',
        authentication_token: 'secret',
        business_registry_configurations: [],
    );

    $request = new UpdateApiConfigurationRequest('uuid-123', $dto);

    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new MockClient([
        MockResponse::make([
            'uuid' => 'uuid-123',
            'event' => 'supplier-invoice',
            'target_url' => 'https://example.com/webhook',
            'authentication_type' => 'header',
            'authentication_key' => 'X-API-KEY',
            'authentication_token' => 'secret',
            'business_registry_configurations' => [],
        ], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);
    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeInstanceOf(ApiConfigurationDto::class)
        ->and($result->uuid)->toBe('uuid-123');
});

