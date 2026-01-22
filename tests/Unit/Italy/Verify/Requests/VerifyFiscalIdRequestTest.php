<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\Verify\Requests\VerifyFiscalIdRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('resolveEndpoint returns correct path', function (): void {
    $request = new VerifyFiscalIdRequest('FISCAL123');

    expect($request->resolveEndpoint())->toBe('/verify/fiscal-id/FISCAL123');
});

test('createDtoFromResponse returns array', function (): void {
    $request = new VerifyFiscalIdRequest('FISCAL123');

    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new MockClient([
        MockResponse::make(['valid' => true], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);
    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeArray()
        ->and($result)->toHaveKey('valid');
});

test('defaultHeaders returns correct headers', function (): void {
    $request = new VerifyFiscalIdRequest('FISCAL123');

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');
    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers['Accept'])->toBe('application/json');
});
