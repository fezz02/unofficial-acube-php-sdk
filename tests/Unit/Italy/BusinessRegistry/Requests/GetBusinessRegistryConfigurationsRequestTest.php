<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\BusinessRegistryConfigurationDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\GetBusinessRegistryConfigurationsRequestDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\GetBusinessRegistryConfigurationsRequest;
use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new GetBusinessRegistryConfigurationsRequestDto();
    $request = new GetBusinessRegistryConfigurationsRequest($dto);

    expect($request->resolveEndpoint())->toBe('/business-registry-configurations');
});

test('createDtoFromResponse returns array of BusinessRegistryConfigurationDto', function (): void {
    $dto = new GetBusinessRegistryConfigurationsRequestDto();
    $request = new GetBusinessRegistryConfigurationsRequest($dto);

    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new MockClient([
        MockResponse::make([
            [
                'fiscal_id' => '12345678901',
                'name' => 'Test Company',
            ],
        ], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);
    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeArray()
        ->and($result[0])->toBeInstanceOf(BusinessRegistryConfigurationDto::class);
});

test('defaultQuery returns correct query parameters', function (): void {
    $dto = new GetBusinessRegistryConfigurationsRequestDto(
        fiscal_id: '12345678901',
        fiscal_id_array: ['12345678901', '98765432101'],
        email: 'test@example.com',
        name: 'Test Company',
        supplier_invoice_enabled: true,
        apply_signature: false,
        apply_legal_storage: true,
        legal_storage_active: false,
        receipts_enabled: true,
        page: 1,
    );
    $request = new GetBusinessRegistryConfigurationsRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultQuery');
    $query = $method->invoke($request);

    expect($query)->toBeArray()
        ->and($query['fiscal_id'])->toBe('12345678901')
        ->and($query['fiscal_id[]'])->toBe(['12345678901', '98765432101'])
        ->and($query['email'])->toBe('test@example.com')
        ->and($query['name'])->toBe('Test Company')
        ->and($query['supplier_invoice_enabled'])->toBeTrue()
        ->and($query['apply_signature'])->toBeFalse()
        ->and($query['apply_legal_storage'])->toBeTrue()
        ->and($query['legal_storage_active'])->toBeFalse()
        ->and($query['receipts_enabled'])->toBeTrue()
        ->and($query['page'])->toBe(1);
});

