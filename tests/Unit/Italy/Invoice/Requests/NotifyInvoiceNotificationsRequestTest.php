<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\Invoice\Dto\NotifyInvoiceRequestDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\Invoice\Requests\NotifyInvoiceNotificationsRequest;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new NotifyInvoiceRequestDto(id: 'invoice-123');
    $request = new NotifyInvoiceNotificationsRequest($dto);

    expect($request->resolveEndpoint())->toBe('/invoices/invoice-123/notifications/notify');
});

test('createDtoFromResponse returns array', function (): void {
    $dto = new NotifyInvoiceRequestDto(id: 'invoice-123');
    $request = new NotifyInvoiceNotificationsRequest($dto);

    $connector = new Fezz\Acube\Sdk\Italy\ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new Saloon\Http\Faking\MockClient([
        Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);

    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeArray()
        ->and($result)->toHaveKey('success');
});

test('defaultHeaders returns correct headers', function (): void {
    $dto = new NotifyInvoiceRequestDto(id: 'invoice-123');
    $request = new NotifyInvoiceNotificationsRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');

    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers['Accept'])->toBe('application/json');
});
