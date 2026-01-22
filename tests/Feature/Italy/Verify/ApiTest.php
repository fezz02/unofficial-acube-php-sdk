<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\Verify\Api;
use Fezz\Acube\Sdk\Italy\Verify\Dto\VerifyPersonRequestDto;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function (): void {
});

test('verify company simple', function (): void {
    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $api = new Api($connector);

    $mockClient = new MockClient([
        MockResponse::make([
            'vat_number' => '12345678901',
            'name' => 'Test Company',
        ], 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->companySimple('12345678901');

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('verify company', function (): void {
    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $api = new Api($connector);

    $mockClient = new MockClient([
        MockResponse::make([
            'vat_number' => '12345678901',
            'name' => 'Test Company',
            'address' => 'Via Roma 1',
        ], 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->company('12345678901');

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('verify fiscal id', function (): void {
    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $api = new Api($connector);

    $mockClient = new MockClient([
        MockResponse::make([
            'fiscal_id' => 'RSSMRA80A01H501U',
            'valid' => true,
        ], 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->fiscalId('RSSMRA80A01H501U');

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('verify person', function (): void {
    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $api = new Api($connector);

    $mockClient = new MockClient([
        MockResponse::make('', 202),
    ]);

    $connector->withMockClient($mockClient);

    $dto = new VerifyPersonRequestDto([
        'fiscal_id' => 'RSSMRA80A01H501U',
    ]);
    $response = $api->person($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(202);
});

test('verify split payment', function (): void {
    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $api = new Api($connector);

    $mockClient = new MockClient([
        MockResponse::make([
            'vat_number' => '12345678901',
            'split_payment' => true,
        ], 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->split('12345678901');

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});
