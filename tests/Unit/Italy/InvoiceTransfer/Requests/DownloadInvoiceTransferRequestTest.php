<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\InvoiceTransfer\Dto\DownloadInvoiceTransferRequestDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\InvoiceTransfer\Requests\DownloadInvoiceTransferRequest;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new DownloadInvoiceTransferRequestDto(id: 'transfer-123');
    $request = new DownloadInvoiceTransferRequest($dto);

    expect($request->resolveEndpoint())->toBe('/invoice-transfers/transfer-123/download');
});

test('createDtoFromResponse returns string body', function (): void {
    $dto = new DownloadInvoiceTransferRequestDto(id: 'transfer-123');
    $request = new DownloadInvoiceTransferRequest($dto);

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
    $dto = new DownloadInvoiceTransferRequestDto(id: 'transfer-123');
    $request = new DownloadInvoiceTransferRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');

    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers['Accept'])->toBe('application/octet-stream');
});
