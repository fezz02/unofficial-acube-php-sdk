<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\PreservedDocument\Dto\GetPreservedDocumentReceiptRequestDto;
use Fezz\Acube\Sdk\Italy\PreservedDocument\Requests\GetPreservedDocumentReceiptRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new GetPreservedDocumentReceiptRequestDto(uuid: 'doc-123');
    $request = new GetPreservedDocumentReceiptRequest($dto);

    expect($request->resolveEndpoint())->toBe('/preserved-documents/doc-123/receipt');
});

test('createDtoFromResponse returns string body', function (): void {
    $dto = new GetPreservedDocumentReceiptRequestDto(uuid: 'doc-123');
    $request = new GetPreservedDocumentReceiptRequest($dto);

    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new MockClient([
        MockResponse::make('<xml>receipt content</xml>', 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);
    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeString()
        ->and($result)->toBe('<xml>receipt content</xml>');
});

test('defaultHeaders returns correct headers', function (): void {
    $dto = new GetPreservedDocumentReceiptRequestDto(uuid: 'doc-123');
    $request = new GetPreservedDocumentReceiptRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');
    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers['Accept'])->toBe('application/xml');
});
