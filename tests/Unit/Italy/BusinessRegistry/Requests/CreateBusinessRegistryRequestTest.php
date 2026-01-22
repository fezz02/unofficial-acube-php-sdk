<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\BusinessRegistryDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\CreateBusinessRegistryRequestDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\CreateBusinessRegistryRequest;
use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Saloon\Enums\Method;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new CreateBusinessRegistryRequestDto(
        head_office_address_street: 'Via Test',
        head_office_address_zip_code: '00100',
        head_office_address_city: 'Roma',
        head_office_address_country: 'IT',
    );
    $request = new CreateBusinessRegistryRequest($dto);

    expect($request->resolveEndpoint())->toBe('/business-registries');
});

test('createDtoFromResponse returns BusinessRegistryDto', function (): void {
    $dto = new CreateBusinessRegistryRequestDto(
        head_office_address_street: 'Via Test',
        head_office_address_zip_code: '00100',
        head_office_address_city: 'Roma',
        head_office_address_country: 'IT',
        business_name: 'Test Company',
    );
    $request = new CreateBusinessRegistryRequest($dto);

    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new MockClient([
        MockResponse::make([
            'uuid' => '550e8400-e29b-41d4-a716-446655440000',
            'head_office_address_street' => 'Via Test',
            'head_office_address_zip_code' => '00100',
            'head_office_address_city' => 'Roma',
            'head_office_address_country' => 'IT',
            'business_name' => 'Test Company',
        ], 201),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);
    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeInstanceOf(BusinessRegistryDto::class)
        ->and($result->uuid)->toBe('550e8400-e29b-41d4-a716-446655440000')
        ->and($result->business_name)->toBe('Test Company');
});

test('defaultBody returns correct body', function (): void {
    $dto = new CreateBusinessRegistryRequestDto(
        head_office_address_street: 'Via Test',
        head_office_address_zip_code: '00100',
        head_office_address_city: 'Roma',
        head_office_address_country: 'IT',
        business_name: 'Test Company',
    );
    $request = new CreateBusinessRegistryRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultBody');
    $body = $method->invoke($request);

    expect($body)->toBeArray()
        ->and($body['head_office_address_street'])->toBe('Via Test')
        ->and($body['head_office_address_city'])->toBe('Roma')
        ->and($body['business_name'])->toBe('Test Company');
});

