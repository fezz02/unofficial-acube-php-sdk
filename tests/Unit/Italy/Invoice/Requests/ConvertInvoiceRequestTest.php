<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\Invoice\Dto\ConvertInvoiceRequestDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\Invoice\Requests\ConvertInvoiceRequest;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new ConvertInvoiceRequestDto(invoice: ['test' => 'data']);
    $request = new ConvertInvoiceRequest($dto);

    expect($request->resolveEndpoint())->toBe('/invoices/convert');
});

test('createDtoFromResponse returns string body', function (): void {
    $dto = new ConvertInvoiceRequestDto(invoice: ['test' => 'data']);
    $request = new ConvertInvoiceRequest($dto);

    $connector = new Fezz\Acube\Sdk\Italy\ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new Saloon\Http\Faking\MockClient([
        Saloon\Http\Faking\MockResponse::make('<xml>test</xml>', 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);

    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeString()
        ->and($result)->toBe('<xml>test</xml>');
});

test('defaultBody returns invoice data', function (): void {
    $invoiceData = ['test' => 'data'];
    $dto = new ConvertInvoiceRequestDto(invoice: $invoiceData);
    $request = new ConvertInvoiceRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultBody');

    $body = $method->invoke($request);

    expect($body)->toBe($invoiceData);
});

test('defaultHeaders returns json content type for array invoice', function (): void {
    $dto = new ConvertInvoiceRequestDto(invoice: ['test' => 'data']);
    $request = new ConvertInvoiceRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');

    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers)->toHaveKey('Content-Type')
        ->and($headers['Accept'])->toBe('application/json')
        ->and($headers['Content-Type'])->toBe('application/json');
});

test('defaultHeaders returns xml content type for string invoice', function (): void {
    $dto = new ConvertInvoiceRequestDto(invoice: '<xml>test</xml>');
    $request = new ConvertInvoiceRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');

    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers)->toHaveKey('Content-Type')
        ->and($headers['Accept'])->toBe('application/json')
        ->and($headers['Content-Type'])->toBe('application/xml');
});
