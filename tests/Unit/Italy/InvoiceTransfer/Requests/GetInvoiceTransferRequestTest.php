<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\InvoiceTransfer\Dto\GetInvoiceTransferRequestDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\InvoiceTransfer\Dto\InvoiceTransferDto;
use Fezz\Acube\Sdk\Italy\InvoiceTransfer\Requests\GetInvoiceTransferRequest;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new GetInvoiceTransferRequestDto(id: 'transfer-123');
    $request = new GetInvoiceTransferRequest($dto);

    expect($request->resolveEndpoint())->toBe('/invoice-transfers/transfer-123');
});

test('createDtoFromResponse returns InvoiceTransferDto', function (): void {
    $dto = new GetInvoiceTransferRequestDto(id: 'transfer-123');
    $request = new GetInvoiceTransferRequest($dto);

    $connector = new Fezz\Acube\Sdk\Italy\ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new Saloon\Http\Faking\MockClient([
        Saloon\Http\Faking\MockResponse::make([
            'uuid' => 'transfer-123',
            'supplier_fiscal_id' => 'FISCAL123',
        ], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);

    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeInstanceOf(InvoiceTransferDto::class);
});

test('defaultHeaders returns correct headers', function (): void {
    $dto = new GetInvoiceTransferRequestDto(id: 'transfer-123');
    $request = new GetInvoiceTransferRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');

    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers['Accept'])->toBe('application/json');
});
