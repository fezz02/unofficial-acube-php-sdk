<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\BusinessRegistryDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\UpdateBusinessRegistryRequestDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\UpdateBusinessRegistryRequest;
use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('resolveEndpoint returns correct path', function (): void {
    $bodyDto = new UpdateBusinessRegistryRequestDto(
        head_office_address_street: 'Via Test',
        head_office_address_zip_code: '00100',
        head_office_address_city: 'Roma',
        head_office_address_country: 'IT',
    );
    $request = new UpdateBusinessRegistryRequest('12345678901', $bodyDto);

    expect($request->resolveEndpoint())->toBe('/business-registries/12345678901');
});

test('createDtoFromResponse returns BusinessRegistryDto', function (): void {
    $bodyDto = new UpdateBusinessRegistryRequestDto(
        head_office_address_street: 'Via Test',
        head_office_address_zip_code: '00100',
        head_office_address_city: 'Roma',
        head_office_address_country: 'IT',
    );
    $request = new UpdateBusinessRegistryRequest('12345678901', $bodyDto);

    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new MockClient([
        MockResponse::make([
            'uuid' => '550e8400-e29b-41d4-a716-446655440000',
            'head_office_address_street' => 'Via Test',
        ], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);
    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeInstanceOf(BusinessRegistryDto::class);
});

test('defaultBody returns correct body', function (): void {
    $bodyDto = new UpdateBusinessRegistryRequestDto(
        head_office_address_street: 'Via Test',
        head_office_address_zip_code: '00100',
        head_office_address_city: 'Roma',
        head_office_address_country: 'IT',
        business_name: 'Updated Company',
    );
    $request = new UpdateBusinessRegistryRequest('12345678901', $bodyDto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultBody');
    $body = $method->invoke($request);

    expect($body)->toBeArray()
        ->and($body['head_office_address_street'])->toBe('Via Test')
        ->and($body['business_name'])->toBe('Updated Company');
});

