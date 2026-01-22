<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\BusinessRegistryConfigurationDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\GetBusinessRegistryConfigurationRequest;
use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('resolveEndpoint returns correct path', function (): void {
    $request = new GetBusinessRegistryConfigurationRequest('12345678901');

    expect($request->resolveEndpoint())->toBe('/business-registry-configurations/12345678901');
});

test('createDtoFromResponse returns BusinessRegistryConfigurationDto', function (): void {
    $request = new GetBusinessRegistryConfigurationRequest('12345678901');

    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new MockClient([
        MockResponse::make([
            'fiscal_id' => '12345678901',
            'name' => 'Test Company',
            'email' => 'test@example.com',
        ], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);
    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeInstanceOf(BusinessRegistryConfigurationDto::class)
        ->and($result->fiscal_id)->toBe('12345678901');
});

