<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\ReceiptSettingsDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\GetReceiptSettingsRequest;
use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('resolveEndpoint returns correct path', function (): void {
    $request = new GetReceiptSettingsRequest('12345678901');

    expect($request->resolveEndpoint())->toBe('/business-registry-configurations/12345678901/receipt-settings');
});

test('createDtoFromResponse returns ReceiptSettingsDto', function (): void {
    $request = new GetReceiptSettingsRequest('12345678901');

    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new MockClient([
        MockResponse::make([
            'phone_number' => '+3912345678',
            'receipts_alert_recipients' => ['alert@example.com'],
        ], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);
    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeInstanceOf(ReceiptSettingsDto::class)
        ->and($result->phone_number)->toBe('+3912345678');
});

