<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\PreservedDocument\Api;
use Fezz\Acube\Sdk\Italy\PreservedDocument\Dto\GetPreservedDocumentReceiptRequestDto;
use Fezz\Acube\Sdk\Italy\PreservedDocument\Dto\GetPreservedDocumentRequestDto;
use Fezz\Acube\Sdk\Italy\PreservedDocument\Dto\GetPreservedDocumentsRequestDto;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function (): void {
});

test('list preserved documents', function (): void {
    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $api = new Api($connector);

    $mockClient = new MockClient([
        MockResponse::make([
            [
                'id' => 'doc-123',
                'uuid' => 'uuid-123',
            ],
        ], 200),
    ]);

    $connector->withMockClient($mockClient);

    $dto = new GetPreservedDocumentsRequestDto([]);
    $response = $api->list($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('get preserved document by id', function (): void {
    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $api = new Api($connector);

    $mockClient = new MockClient([
        MockResponse::make([
            'id' => 'doc-123',
            'uuid' => 'uuid-123',
        ], 200),
    ]);

    $connector->withMockClient($mockClient);

    $dto = new GetPreservedDocumentRequestDto('doc-123');
    $response = $api->get($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('get preserved document receipt', function (): void {
    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $api = new Api($connector);

    $mockClient = new MockClient([
        MockResponse::make('<xml>receipt content</xml>', 200, ['Content-Type' => 'application/xml']),
    ]);

    $connector->withMockClient($mockClient);

    $dto = new GetPreservedDocumentReceiptRequestDto('uuid-123');
    $response = $api->getReceipt($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200)
        ->and($response->body())->toBe('<xml>receipt content</xml>');
});
