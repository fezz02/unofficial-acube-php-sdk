<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\ApiConfiguration\Dto\ApiConfigurationDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\ApiConfiguration\Dto\CreateApiConfigurationRequestDto;
use Fezz\Acube\Sdk\Italy\ApiConfiguration\Requests\CreateApiConfigurationRequest;
use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('create api configuration resolveEndpoint returns correct path', function (): void {
    $dto = new CreateApiConfigurationRequestDto(
        event: 'supplier-invoice',
        target_url: 'https://example.com/webhook',
        authentication_type: 'header',
    );
    $request = new CreateApiConfigurationRequest($dto);

    expect($request->resolveEndpoint())->toBe('/api-configurations');
});

test('create api configuration defaultBody filters null values', function (): void {
    $dto = new CreateApiConfigurationRequestDto(
        event: 'supplier-invoice',
        target_url: 'https://example.com/webhook',
        authentication_type: 'header',
        authentication_key: null,
        authentication_token: null,
        business_registry_configurations: [],
    );
    $request = new CreateApiConfigurationRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultBody');
    /** @var array<string, mixed> $body */
    $body = $method->invoke($request);

    expect($body)
        ->toHaveKey('event', 'supplier-invoice')
        ->toHaveKey('target_url', 'https://example.com/webhook')
        ->not->toHaveKey('authentication_key')
        ->not->toHaveKey('authentication_token');
});

test('create api configuration createDtoFromResponse returns ApiConfigurationDto', function (): void {
    $dto = new CreateApiConfigurationRequestDto(
        event: 'supplier-invoice',
        target_url: 'https://example.com/webhook',
        authentication_type: 'header',
    );
    $request = new CreateApiConfigurationRequest($dto);

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
        ], 201),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);
    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeInstanceOf(ApiConfigurationDto::class)
        ->and($result->uuid)->toBe('cfg-123');
});




