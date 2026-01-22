<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\Invoice\Dto\CreateSimplifiedDraftInvoiceRequestDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\Invoice\Dto\InvoiceDto;
use Fezz\Acube\Sdk\Italy\Invoice\Requests\CreateSimplifiedDraftInvoiceRequest;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new CreateSimplifiedDraftInvoiceRequestDto(invoice: ['test' => 'data']);
    $request = new CreateSimplifiedDraftInvoiceRequest($dto);

    expect($request->resolveEndpoint())->toBe('/invoices/simplified/draft');
});

test('createDtoFromResponse returns InvoiceDto', function (): void {
    $dto = new CreateSimplifiedDraftInvoiceRequestDto(invoice: ['test' => 'data']);
    $request = new CreateSimplifiedDraftInvoiceRequest($dto);

    $connector = new Fezz\Acube\Sdk\Italy\ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new Saloon\Http\Faking\MockClient([
        Saloon\Http\Faking\MockResponse::make([
            'uuid' => 'invoice-123',
            'marking' => 'waiting',
        ], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);

    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeInstanceOf(InvoiceDto::class);
});

test('defaultBody returns invoice data as array when not DTO', function (): void {
    $invoiceData = ['test' => 'data'];
    $dto = new CreateSimplifiedDraftInvoiceRequestDto(invoice: $invoiceData);
    $request = new CreateSimplifiedDraftInvoiceRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultBody');

    $body = $method->invoke($request);

    expect($body)->toBe($invoiceData);
});

test('defaultBody returns invoice data from DTO all() method when DTO instance', function (): void {
    $fatturaDto = new Fezz\Acube\Sdk\Italy\Invoice\Dto\FatturaElettronicaSemplificataDto(
        fattura_elettronica_header: ['header' => 'data'],
        fattura_elettronica_body: [['body' => 'data']]
    );
    $dto = new CreateSimplifiedDraftInvoiceRequestDto(invoice: $fatturaDto);
    $request = new CreateSimplifiedDraftInvoiceRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultBody');

    $body = $method->invoke($request);

    expect($body)->toBeArray()
        ->and($body)->toHaveKey('fattura_elettronica_header')
        ->and($body)->toHaveKey('fattura_elettronica_body');
});

test('defaultHeaders returns correct headers', function (): void {
    $dto = new CreateSimplifiedDraftInvoiceRequestDto(invoice: ['test' => 'data']);
    $request = new CreateSimplifiedDraftInvoiceRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');

    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers)->toHaveKey('Content-Type')
        ->and($headers['Accept'])->toBe('application/json')
        ->and($headers['Content-Type'])->toBe('application/json');
});
