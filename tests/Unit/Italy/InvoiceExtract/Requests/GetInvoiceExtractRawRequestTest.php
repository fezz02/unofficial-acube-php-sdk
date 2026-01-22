<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\InvoiceExtract\Dto\GetInvoiceExtractRawRequestDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\InvoiceExtract\Requests\GetInvoiceExtractRawRequest;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new GetInvoiceExtractRawRequestDto(uuid: 'extract-123');
    $request = new GetInvoiceExtractRawRequest($dto);

    expect($request->resolveEndpoint())->toBe('/invoice-extract/extract-123/raw');
});

test('createDtoFromResponse returns array', function (): void {
    $dto = new GetInvoiceExtractRawRequestDto(uuid: 'extract-123');
    $request = new GetInvoiceExtractRawRequest($dto);

    $connector = new Fezz\Acube\Sdk\Italy\ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new Saloon\Http\Faking\MockClient([
        Saloon\Http\Faking\MockResponse::make(['extracted' => 'data'], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);

    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeArray()
        ->and($result)->toHaveKey('extracted');
});

test('defaultHeaders returns correct headers', function (): void {
    $dto = new GetInvoiceExtractRawRequestDto(uuid: 'extract-123');
    $request = new GetInvoiceExtractRawRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');

    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers['Accept'])->toBe('application/json');
});
