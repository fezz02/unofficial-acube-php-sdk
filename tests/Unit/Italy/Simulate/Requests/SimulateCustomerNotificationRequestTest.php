<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\Simulate\Requests\SimulateCustomerNotificationRequest;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('simulate customer notification builds correct endpoint without xml', function (): void {
    $request = new SimulateCustomerNotificationRequest('NS', 'invoice-uuid-123');

    expect($request->resolveEndpoint())
        ->toBe('/simulate/customer-notification/NS/invoice-uuid-123');

    $reflection = new ReflectionClass($request);
    $headersMethod = $reflection->getMethod('defaultHeaders');
    /** @var array<string, string> $headers */
    $headers = $headersMethod->invoke($request);

    expect($headers)
        ->toHaveKey('Accept', 'application/json')
        ->not->toHaveKey('Content-Type');
});

test('simulate customer notification sets xml headers when xml body is provided', function (): void {
    $xml = '<xml>body</xml>';
    $request = new SimulateCustomerNotificationRequest('NS', 'invoice-uuid-123', $xml);

    $reflection = new ReflectionClass($request);
    $headersMethod = $reflection->getMethod('defaultHeaders');
    /** @var array<string, string> $headers */
    $headers = $headersMethod->invoke($request);

    $bodyMethod = $reflection->getMethod('defaultBody');
    /** @var string $body */
    $body = $bodyMethod->invoke($request);

    expect($headers)
        ->toHaveKey('Accept', 'application/json')
        ->toHaveKey('Content-Type', 'application/xml');

    expect($body)->toBe($xml);
});

test('simulate customer notification createDtoFromResponse returns array for json', function (): void {
    $request = new SimulateCustomerNotificationRequest('NS', 'invoice-uuid-123');

    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new MockClient([
        MockResponse::make(['message' => 'ok'], 200, ['Content-Type' => 'application/json']),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);
    $result = $request->createDtoFromResponse($response);

    expect($result)
        ->toBeArray()
        ->and($result['message'])->toBe('ok');
});


