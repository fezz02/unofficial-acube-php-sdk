<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\Invoice\Dto\GetInvoiceStatsRequestDto;
use Fezz\Acube\Sdk\Italy\Invoice\Requests\GetInvoiceStatsRequest;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new GetInvoiceStatsRequestDto(year: '2024');
    $request = new GetInvoiceStatsRequest($dto);

    expect($request->resolveEndpoint())->toBe('/invoices/stats/2024');
});

test('createDtoFromResponse returns array', function (): void {
    $dto = new GetInvoiceStatsRequestDto(year: '2024');
    $request = new GetInvoiceStatsRequest($dto);

    $connector = new Fezz\Acube\Sdk\Italy\ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new Saloon\Http\Faking\MockClient([
        Saloon\Http\Faking\MockResponse::make(['total' => 100], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);

    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeArray()
        ->and($result)->toHaveKey('total');
});

test('defaultQuery includes fiscal_id when provided', function (): void {
    $dto = new GetInvoiceStatsRequestDto(year: '2024', fiscal_id: 'FISCAL123');
    $request = new GetInvoiceStatsRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultQuery');

    $query = $method->invoke($request);

    expect($query)->toBeArray()
        ->and($query)->toHaveKey('fiscal_id')
        ->and($query['fiscal_id'])->toBe('FISCAL123');
});

test('defaultQuery excludes fiscal_id when not provided', function (): void {
    $dto = new GetInvoiceStatsRequestDto(year: '2024');
    $request = new GetInvoiceStatsRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultQuery');

    $query = $method->invoke($request);

    expect($query)->toBeArray()
        ->and($query)->not->toHaveKey('fiscal_id');
});

test('defaultHeaders returns correct headers', function (): void {
    $dto = new GetInvoiceStatsRequestDto(year: '2024');
    $request = new GetInvoiceStatsRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');

    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers['Accept'])->toBe('application/json');
});
