<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\BusinessRegistryDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\GetBusinessRegistriesRequestDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\GetBusinessRegistriesRequest;
use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new GetBusinessRegistriesRequestDto();
    $request = new GetBusinessRegistriesRequest($dto);

    expect($request->resolveEndpoint())->toBe('/business-registries');
});

test('createDtoFromResponse returns array of BusinessRegistryDto', function (): void {
    $dto = new GetBusinessRegistriesRequestDto();
    $request = new GetBusinessRegistriesRequest($dto);

    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new MockClient([
        MockResponse::make([
            [
                'uuid' => '550e8400-e29b-41d4-a716-446655440000',
                'head_office_address_street' => 'Via Test',
                'head_office_address_zip_code' => '00100',
                'head_office_address_city' => 'Roma',
                'head_office_address_country' => 'IT',
            ],
        ], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);
    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeArray()
        ->and($result[0])->toBeInstanceOf(BusinessRegistryDto::class);
});

test('defaultQuery returns correct query parameters', function (): void {
    $dto = new GetBusinessRegistriesRequestDto(simpleSearch: 'Test', page: 1);
    $request = new GetBusinessRegistriesRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultQuery');
    $query = $method->invoke($request);

    expect($query)->toBeArray()
        ->and($query['simpleSearch'])->toBe('Test')
        ->and($query['page'])->toBe(1);
});

test('defaultQuery handles null values', function (): void {
    $dto = new GetBusinessRegistriesRequestDto();
    $request = new GetBusinessRegistriesRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultQuery');
    $query = $method->invoke($request);

    expect($query)->toBeArray()
        ->and($query)->toBeEmpty();
});

