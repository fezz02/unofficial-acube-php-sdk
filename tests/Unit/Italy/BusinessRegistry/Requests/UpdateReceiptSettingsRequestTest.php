<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\ReceiptSettingsDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\UpdateReceiptSettingsRequestDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\UpdateReceiptSettingsRequest;
use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new UpdateReceiptSettingsRequestDto(
        phone_number: '+3912345678',
    );
    $request = new UpdateReceiptSettingsRequest('12345678901', $dto);

    expect($request->resolveEndpoint())->toBe('/business-registry-configurations/12345678901/receipt-settings');
});

test('createDtoFromResponse returns ReceiptSettingsDto', function (): void {
    $dto = new UpdateReceiptSettingsRequestDto(
        phone_number: '+3912345678',
    );
    $request = new UpdateReceiptSettingsRequest('12345678901', $dto);

    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new MockClient([
        MockResponse::make([
            'phone_number' => '+3912345678',
        ], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);
    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeInstanceOf(ReceiptSettingsDto::class);
});

test('defaultBody returns correct body', function (): void {
    $dto = new UpdateReceiptSettingsRequestDto(
        phone_number: '+3912345678',
        receipts_alert_recipients: ['alert@example.com'],
    );
    $request = new UpdateReceiptSettingsRequest('12345678901', $dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultBody');
    $body = $method->invoke($request);

    expect($body)->toBeArray()
        ->and($body['phone_number'])->toBe('+3912345678')
        ->and($body['receipts_alert_recipients'])->toHaveCount(1);
});

test('defaultBody handles null receipts_alert_recipients', function (): void {
    $dto = new UpdateReceiptSettingsRequestDto(
        phone_number: '+3912345678',
    );
    $request = new UpdateReceiptSettingsRequest('12345678901', $dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultBody');
    $body = $method->invoke($request);

    expect($body)->toBeArray()
        ->and($body)->not->toHaveKey('receipts_alert_recipients');
});

