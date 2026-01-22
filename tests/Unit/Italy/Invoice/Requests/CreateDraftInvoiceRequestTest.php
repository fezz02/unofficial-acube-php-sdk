<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\Invoice\Dto\CreateDraftInvoiceRequestDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\Invoice\Dto\InvoiceDto;
use Fezz\Acube\Sdk\Italy\Invoice\Requests\CreateDraftInvoiceRequest;

test('defaultBody returns invoice data from dto when invoice is array', function (): void {
    $dto = new CreateDraftInvoiceRequestDto(invoice: ['header' => [], 'body' => []]);
    $request = new CreateDraftInvoiceRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultBody');

    $body = $method->invoke($request);

    expect($body)->toBeArray()
        ->and($body)->toHaveKey('header')
        ->and($body)->toHaveKey('body');
});

test('defaultBody returns invoice data from dto when invoice is DTO', function (): void {
    $invoiceDto = new Fezz\Acube\Sdk\Italy\Invoice\Dto\FatturaElettronicaDto(
        new Fezz\Acube\Sdk\Italy\Invoice\Dto\FatturaElettronicaHeaderDto(
            dati_trasmissione: [],
            cedente_prestatore: [],
            cessionario_committente: []
        ),
        []
    );
    $dto = new CreateDraftInvoiceRequestDto(invoice: $invoiceDto);
    $request = new CreateDraftInvoiceRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultBody');

    $body = $method->invoke($request);

    expect($body)->toBeArray();
});

test('createDtoFromResponse returns InvoiceDto', function (): void {
    $dto = new CreateDraftInvoiceRequestDto(invoice: []);
    $request = new CreateDraftInvoiceRequest($dto);

    $connector = new Fezz\Acube\Sdk\Italy\ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new Saloon\Http\Faking\MockClient([
        Saloon\Http\Faking\MockResponse::make([
            'id' => 'draft-123',
            'uuid' => 'uuid-123',
            'marking' => 'waiting',
        ], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);

    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeInstanceOf(InvoiceDto::class);
});

test('defaultHeaders returns correct headers', function (): void {
    $dto = new CreateDraftInvoiceRequestDto(invoice: []);
    $request = new CreateDraftInvoiceRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');

    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers)->toHaveKey('Content-Type');
});
