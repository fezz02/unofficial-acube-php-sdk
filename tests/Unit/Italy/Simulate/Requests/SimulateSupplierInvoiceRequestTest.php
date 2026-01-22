<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\Simulate\Dto\SupplierInvoiceSimulationDto;
use Fezz\Acube\Sdk\Italy\Simulate\Requests\SimulateSupplierInvoiceRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('simulate supplier invoice resolveEndpoint returns correct path', function (): void {
    $dto = SupplierInvoiceSimulationDto::fromJson(['foo' => 'bar']);
    $request = new SimulateSupplierInvoiceRequest($dto);

    expect($request->resolveEndpoint())->toBe('/simulate/supplier-invoice');
});

test('simulate supplier invoice defaultHeaders use dto content type', function (): void {
    $jsonDto = SupplierInvoiceSimulationDto::fromJson(['foo' => 'bar']);
    $jsonRequest = new SimulateSupplierInvoiceRequest($jsonDto);

    $reflection = new ReflectionClass($jsonRequest);
    $headersMethod = $reflection->getMethod('defaultHeaders');
    /** @var array<string, string> $jsonHeaders */
    $jsonHeaders = $headersMethod->invoke($jsonRequest);

    expect($jsonHeaders)
        ->toHaveKey('Accept', 'application/json')
        ->toHaveKey('Content-Type', 'application/json');

    $xmlDto = SupplierInvoiceSimulationDto::fromXml('<Invoice/>');
    $xmlRequest = new SimulateSupplierInvoiceRequest($xmlDto);
    /** @var array<string, string> $xmlHeaders */
    $xmlHeaders = $headersMethod->invoke($xmlRequest);

    expect($xmlHeaders)
        ->toHaveKey('Accept', 'application/json')
        ->toHaveKey('Content-Type', 'application/xml');
});

test('simulate supplier invoice defaultBody encodes json and forwards xml', function (): void {
    $jsonDto = SupplierInvoiceSimulationDto::fromJson(['foo' => 'bar']);
    $jsonRequest = new SimulateSupplierInvoiceRequest($jsonDto);

    $reflection = new ReflectionClass($jsonRequest);
    $bodyMethod = $reflection->getMethod('defaultBody');
    /** @var string $jsonBody */
    $jsonBody = $bodyMethod->invoke($jsonRequest);

    expect($jsonBody)->toBe(json_encode(['foo' => 'bar'], JSON_THROW_ON_ERROR));

    $xml = '<Invoice>test</Invoice>';
    $xmlDto = SupplierInvoiceSimulationDto::fromXml($xml);
    $xmlRequest = new SimulateSupplierInvoiceRequest($xmlDto);
    /** @var string $xmlBody */
    $xmlBody = $bodyMethod->invoke($xmlRequest);

    expect($xmlBody)->toBe($xml);
});

test('simulate supplier invoice createDtoFromResponse returns array', function (): void {
    $dto = SupplierInvoiceSimulationDto::fromJson(['foo' => 'bar']);
    $request = new SimulateSupplierInvoiceRequest($dto);

    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new MockClient([
        MockResponse::make(['result' => 'ok'], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);
    $result = $request->createDtoFromResponse($response);

    expect($result)
        ->toBeArray()
        ->and($result['result'])->toBe('ok');
});




