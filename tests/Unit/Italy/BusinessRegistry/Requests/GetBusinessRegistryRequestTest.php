<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\BusinessRegistryDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\GetBusinessRegistryRequest;
use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Saloon\Enums\Method;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('resolveEndpoint returns correct path', function (): void {
    $request = new GetBusinessRegistryRequest('12345678901');

    expect($request->resolveEndpoint())->toBe('/business-registries/12345678901');
});

test('createDtoFromResponse returns BusinessRegistryDto', function (): void {
    $request = new GetBusinessRegistryRequest('12345678901');

    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new MockClient([
        MockResponse::make([
            'uuid' => '550e8400-e29b-41d4-a716-446655440000',
            'head_office_address_street' => 'Via Test',
            'head_office_address_zip_code' => '00100',
            'head_office_address_city' => 'Roma',
            'head_office_address_country' => 'IT',
            'business_name' => 'Test Company',
        ], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);
    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeInstanceOf(BusinessRegistryDto::class)
        ->and($result->uuid)->toBe('550e8400-e29b-41d4-a716-446655440000')
        ->and($result->head_office_address_street)->toBe('Via Test')
        ->and($result->business_name)->toBe('Test Company');
});

test('defaultHeaders returns correct headers', function (): void {
    $request = new GetBusinessRegistryRequest('12345678901');

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');
    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers['Accept'])->toBe('application/json');
});

