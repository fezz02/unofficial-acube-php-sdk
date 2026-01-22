<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\Receipt\Requests\GetReceiptDetailsRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('resolveEndpoint returns correct path', function (): void {
    $request = new GetReceiptDetailsRequest('receipt-123');

    expect($request->resolveEndpoint())->toBe('/receipts/receipt-123/details');
});

test('createDtoFromResponse returns JSON array when Content-Type is application/json', function (): void {
    $request = new GetReceiptDetailsRequest('receipt-123');

    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new MockClient([
        MockResponse::make([
            'uuid' => 'receipt-123',
            'fiscal_id' => 'FISCAL123',
        ], 200, ['Content-Type' => 'application/json']),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);
    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeArray()
        ->and($result)->toHaveKey('uuid')
        ->and($result['uuid'])->toBe('receipt-123');
});

test('createDtoFromResponse returns JSON array when Content-Type is array with application/json', function (): void {
    $request = new GetReceiptDetailsRequest('receipt-123');

    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new MockClient([
        MockResponse::make([
            'uuid' => 'receipt-123',
            'fiscal_id' => 'FISCAL123',
        ], 200, ['Content-Type' => 'application/json']),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);

    // Create a wrapper that returns array for Content-Type header to test line 58
    $reflection = new ReflectionClass($response);
    $psrRequest = $reflection->getProperty('psrRequest');
    $psrResponse = $reflection->getProperty('psrResponse');
    $pendingRequest = $reflection->getProperty('pendingRequest');

    $mockResponse = new class($psrResponse->getValue($response), $pendingRequest->getValue($response), $psrRequest->getValue($response)) extends Saloon\Http\Response
    {
        public function header(string $key): string|array|null
        {
            if ($key === 'Content-Type') {
                return ['application/json'];
            }

            return parent::header($key);
        }
    };

    $result = $request->createDtoFromResponse($mockResponse);

    expect($result)->toBeArray()
        ->and($result)->toHaveKey('uuid')
        ->and($result['uuid'])->toBe('receipt-123');
});

test('createDtoFromResponse returns string body when Content-Type is not application/json', function (): void {
    $request = new GetReceiptDetailsRequest('receipt-123');

    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new MockClient([
        MockResponse::make('PDF content here', 200, ['Content-Type' => 'application/pdf']),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);
    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeString()
        ->and($result)->toBe('PDF content here');
});

test('createDtoFromResponse returns string body when Content-Type is empty', function (): void {
    $request = new GetReceiptDetailsRequest('receipt-123');

    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new MockClient([
        MockResponse::make('PDF content here', 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);
    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeString()
        ->and($result)->toBe('PDF content here');
});

test('defaultHeaders returns correct headers', function (): void {
    $request = new GetReceiptDetailsRequest('receipt-123');

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');
    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers['Accept'])->toBe('application/json');
});
