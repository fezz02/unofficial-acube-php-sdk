<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\BusinessRegistryConfigurationDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\UpdateBusinessRegistryConfigurationRequestDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\UpdateBusinessRegistryConfigurationRequest;
use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('resolveEndpoint returns correct path', function (): void {
    $bodyDto = new UpdateBusinessRegistryConfigurationRequestDto(
        fiscal_id: '12345678901',
        name: 'Updated Company',
    );
    $request = new UpdateBusinessRegistryConfigurationRequest('12345678901', $bodyDto);

    expect($request->resolveEndpoint())->toBe('/business-registry-configurations/12345678901');
});

test('createDtoFromResponse returns BusinessRegistryConfigurationDto', function (): void {
    $bodyDto = new UpdateBusinessRegistryConfigurationRequestDto(
        fiscal_id: '12345678901',
    );
    $request = new UpdateBusinessRegistryConfigurationRequest('12345678901', $bodyDto);

    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new MockClient([
        MockResponse::make([
            'fiscal_id' => '12345678901',
            'name' => 'Updated Company',
        ], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);
    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeInstanceOf(BusinessRegistryConfigurationDto::class);
});

test('defaultBody returns correct body', function (): void {
    $bodyDto = new UpdateBusinessRegistryConfigurationRequestDto(
        fiscal_id: '12345678901',
        receipts_enabled: true,
    );
    $request = new UpdateBusinessRegistryConfigurationRequest('12345678901', $bodyDto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultBody');
    $body = $method->invoke($request);

    expect($body)->toBeArray()
        ->and($body['fiscal_id'])->toBe('12345678901')
        ->and($body['receipts_enabled'])->toBeTrue();
});

