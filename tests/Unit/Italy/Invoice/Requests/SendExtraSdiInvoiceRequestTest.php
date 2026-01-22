<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\Invoice\Dto\SendExtraSdiInvoiceRequestDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\Invoice\Dto\SendInvoiceResponseDto;
use Fezz\Acube\Sdk\Italy\Invoice\Requests\SendExtraSdiInvoiceRequest;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new SendExtraSdiInvoiceRequestDto(invoice: ['test' => 'data']);
    $request = new SendExtraSdiInvoiceRequest($dto);

    expect($request->resolveEndpoint())->toBe('/invoices/extra-sdi');
});

test('createDtoFromResponse returns SendInvoiceResponseDto', function (): void {
    $dto = new SendExtraSdiInvoiceRequestDto(invoice: ['test' => 'data']);
    $request = new SendExtraSdiInvoiceRequest($dto);

    $connector = new Fezz\Acube\Sdk\Italy\ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new Saloon\Http\Faking\MockClient([
        Saloon\Http\Faking\MockResponse::make(['uuid' => 'invoice-123'], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);

    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeInstanceOf(SendInvoiceResponseDto::class);
});

test('defaultBody returns invoice data', function (): void {
    $invoiceData = ['test' => 'data'];
    $dto = new SendExtraSdiInvoiceRequestDto(invoice: $invoiceData);
    $request = new SendExtraSdiInvoiceRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultBody');

    $body = $method->invoke($request);

    expect($body)->toBe($invoiceData);
});

test('defaultHeaders returns correct headers', function (): void {
    $dto = new SendExtraSdiInvoiceRequestDto(invoice: ['test' => 'data']);
    $request = new SendExtraSdiInvoiceRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');

    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers)->toHaveKey('Content-Type')
        ->and($headers['Accept'])->toBe('application/json')
        ->and($headers['Content-Type'])->toBe('application/json');
});
