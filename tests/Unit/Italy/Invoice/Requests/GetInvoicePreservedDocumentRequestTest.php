<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\Invoice\Dto\GetInvoicePreservedDocumentRequestDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\Invoice\Requests\GetInvoicePreservedDocumentRequest;
use Fezz\Acube\Sdk\Italy\PreservedDocument\Dto\PreservedDocumentDto;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new GetInvoicePreservedDocumentRequestDto(id: 'invoice-123');
    $request = new GetInvoicePreservedDocumentRequest($dto);

    expect($request->resolveEndpoint())->toBe('/invoices/invoice-123/preserved-document');
});

test('createDtoFromResponse returns PreservedDocumentDto', function (): void {
    $dto = new GetInvoicePreservedDocumentRequestDto(id: 'invoice-123');
    $request = new GetInvoicePreservedDocumentRequest($dto);

    $connector = new Fezz\Acube\Sdk\Italy\ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new Saloon\Http\Faking\MockClient([
        Saloon\Http\Faking\MockResponse::make([
            'id' => 'preserved-123',
            'document_type' => 'invoice',
        ], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);

    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeInstanceOf(PreservedDocumentDto::class);
});

test('defaultHeaders returns correct headers', function (): void {
    $dto = new GetInvoicePreservedDocumentRequestDto(id: 'invoice-123');
    $request = new GetInvoicePreservedDocumentRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');

    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers['Accept'])->toBe('application/json');
});
