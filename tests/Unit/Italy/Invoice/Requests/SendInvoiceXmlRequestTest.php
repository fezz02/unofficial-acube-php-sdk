<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\Invoice\Dto\SendInvoiceResponseDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\Invoice\Requests\SendInvoiceXmlRequest;
use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('send invoice xml resolveEndpoint returns correct path', function (): void {
    $request = new SendInvoiceXmlRequest('<Invoice>test</Invoice>');

    expect($request->resolveEndpoint())->toBe('/invoices');
});

test('send invoice xml createDtoFromResponse returns SendInvoiceResponseDto', function (): void {
    $request = new SendInvoiceXmlRequest('<Invoice>test</Invoice>');

    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new MockClient([
        MockResponse::make([
            'uuid' => 'invoice-123',
        ], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);
    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeInstanceOf(SendInvoiceResponseDto::class)
        ->and($result->uuid)->toBe('invoice-123');
});

test('send invoice xml defaultHeaders returns correct headers', function (): void {
    $request = new SendInvoiceXmlRequest('<Invoice>test</Invoice>');

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');

    /** @var array<string, string> $headers */
    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers['Accept'])->toBe('application/json')
        ->and($headers)->toHaveKey('Content-Type')
        ->and($headers['Content-Type'])->toBe('application/xml');
});

test('send invoice xml defaultBody returns xml payload', function (): void {
    $xml = '<Invoice>test</Invoice>';
    $request = new SendInvoiceXmlRequest($xml);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultBody');

    /** @var string $body */
    $body = $method->invoke($request);

    expect($body)->toBe($xml);
});


