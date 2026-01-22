<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\Invoice\Dto\MarkInvoicesDownloadedRequestDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\Invoice\Requests\MarkInvoicesDownloadedRequest;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new MarkInvoicesDownloadedRequestDto(uuids: ['uuid-1', 'uuid-2']);
    $request = new MarkInvoicesDownloadedRequest($dto);

    expect($request->resolveEndpoint())->toBe('/invoices/downloaded');
});

test('createDtoFromResponse returns array', function (): void {
    $dto = new MarkInvoicesDownloadedRequestDto(uuids: ['uuid-1']);
    $request = new MarkInvoicesDownloadedRequest($dto);

    $connector = new Fezz\Acube\Sdk\Italy\ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new Saloon\Http\Faking\MockClient([
        Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);

    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeArray()
        ->and($result)->toHaveKey('success');
});

test('defaultBody returns uuids array', function (): void {
    $uuids = ['uuid-1', 'uuid-2'];
    $dto = new MarkInvoicesDownloadedRequestDto(uuids: $uuids);
    $request = new MarkInvoicesDownloadedRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultBody');

    $body = $method->invoke($request);

    expect($body)->toBeArray()
        ->and($body)->toHaveKey('uuids')
        ->and($body['uuids'])->toBe($uuids);
});

test('defaultHeaders returns correct headers', function (): void {
    $dto = new MarkInvoicesDownloadedRequestDto(uuids: ['uuid-1']);
    $request = new MarkInvoicesDownloadedRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');

    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers)->toHaveKey('Content-Type')
        ->and($headers['Accept'])->toBe('application/json')
        ->and($headers['Content-Type'])->toBe('application/json');
});
