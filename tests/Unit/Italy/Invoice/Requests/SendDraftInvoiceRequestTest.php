<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\Invoice\Dto\InvoiceDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\Invoice\Dto\SendDraftInvoiceRequestDto;
use Fezz\Acube\Sdk\Italy\Invoice\Requests\SendDraftInvoiceRequest;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new SendDraftInvoiceRequestDto(id: 'draft-123');
    $request = new SendDraftInvoiceRequest($dto);

    expect($request->resolveEndpoint())->toBe('/invoices/draft/draft-123/send');
});

test('createDtoFromResponse returns InvoiceDto', function (): void {
    $dto = new SendDraftInvoiceRequestDto(id: 'draft-123');
    $request = new SendDraftInvoiceRequest($dto);

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

test('defaultHeaders returns correct headers', function (): void {
    $dto = new SendDraftInvoiceRequestDto(id: 'draft-123');
    $request = new SendDraftInvoiceRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');

    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers['Accept'])->toBe('application/json');
});
