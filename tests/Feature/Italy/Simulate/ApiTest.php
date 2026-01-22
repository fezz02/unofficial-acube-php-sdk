<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\AcubeApi;
use Fezz\Acube\Sdk\Italy\Simulate\Dto\SupplierInvoiceSimulationDto;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function (): void {
});

test('can simulate supplier invoice from json', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->simulate();

    $mockClient = new MockClient([
        MockResponse::make(['result' => 'ok'], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $api->supplierInvoiceJson(['foo' => 'bar']);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('can simulate supplier invoice from dto', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->simulate();

    $mockClient = new MockClient([
        MockResponse::make(['result' => 'ok'], 200),
    ]);
    $connector->withMockClient($mockClient);

    $dto = SupplierInvoiceSimulationDto::fromJson(['foo' => 'bar']);
    $response = $api->supplierInvoice($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('can simulate supplier invoice from xml', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->simulate();

    $mockClient = new MockClient([
        MockResponse::make(['result' => 'ok'], 200),
    ]);
    $connector->withMockClient($mockClient);

    $xml = '<Invoice>test</Invoice>';
    $response = $api->supplierInvoiceXml($xml);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('can simulate customer notification without xml', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->simulate();

    $mockClient = new MockClient([
        MockResponse::make(['message' => 'ok'], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $api->customerNotification('NS', 'invoice-uuid-123');

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('can simulate customer notification with xml body', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->simulate();

    $mockClient = new MockClient([
        MockResponse::make(['message' => 'ok'], 200),
    ]);
    $connector->withMockClient($mockClient);

    $xml = '<Notification>test</Notification>';
    $response = $api->customerNotificationXml('NS', 'invoice-uuid-123', $xml);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});


