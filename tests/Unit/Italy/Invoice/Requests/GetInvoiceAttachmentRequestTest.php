<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\Invoice\Dto\GetInvoiceAttachmentRequestDto;
use Fezz\Acube\Sdk\Italy\Invoice\Requests\GetInvoiceAttachmentRequest;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new GetInvoiceAttachmentRequestDto(uuid: 'invoice-123', index: 0);
    $request = new GetInvoiceAttachmentRequest($dto);

    expect($request->resolveEndpoint())->toBe('/invoices/invoice-123/attachments/0');
});

test('createDtoFromResponse returns string body', function (): void {
    $dto = new GetInvoiceAttachmentRequestDto(uuid: 'invoice-123', index: 0);
    $request = new GetInvoiceAttachmentRequest($dto);

    $connector = new Fezz\Acube\Sdk\Italy\ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new Saloon\Http\Faking\MockClient([
        Saloon\Http\Faking\MockResponse::make('file content', 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);

    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeString()
        ->and($result)->toBe('file content');
});

test('defaultHeaders returns correct headers', function (): void {
    $dto = new GetInvoiceAttachmentRequestDto(uuid: 'invoice-123', index: 0);
    $request = new GetInvoiceAttachmentRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');

    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers['Accept'])->toBe('application/octet-stream');
});
