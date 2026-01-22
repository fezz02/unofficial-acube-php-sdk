<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\Invoice\Dto\PreserveInvoiceRequestDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\Invoice\Requests\PreserveInvoiceRequest;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new PreserveInvoiceRequestDto(uuid: 'invoice-123');
    $request = new PreserveInvoiceRequest($dto);

    expect($request->resolveEndpoint())->toBe('/invoices/invoice-123/preserve');
});

test('createDtoFromResponse returns array', function (): void {
    $dto = new PreserveInvoiceRequestDto(uuid: 'invoice-123');
    $request = new PreserveInvoiceRequest($dto);

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
    $dto = new PreserveInvoiceRequestDto(uuid: 'invoice-123');
    $request = new PreserveInvoiceRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');

    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers['Accept'])->toBe('application/json');
});
