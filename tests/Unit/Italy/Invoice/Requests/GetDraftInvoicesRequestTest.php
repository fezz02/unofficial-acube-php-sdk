<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\Invoice\Dto\GetDraftInvoicesRequestDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\Invoice\Dto\GetInvoicesResponseDto;
use Fezz\Acube\Sdk\Italy\Invoice\Requests\GetDraftInvoicesRequest;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new GetDraftInvoicesRequestDto(query: []);
    $request = new GetDraftInvoicesRequest($dto);

    expect($request->resolveEndpoint())->toBe('/invoices/draft');
});

test('createDtoFromResponse returns GetInvoicesResponseDto', function (): void {
    $dto = new GetDraftInvoicesRequestDto(query: []);
    $request = new GetDraftInvoicesRequest($dto);

    $connector = new Fezz\Acube\Sdk\Italy\ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new Saloon\Http\Faking\MockClient([
        Saloon\Http\Faking\MockResponse::make([], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);

    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeInstanceOf(GetInvoicesResponseDto::class);
});

test('defaultQuery returns query parameters from dto', function (): void {
    $dto = new GetDraftInvoicesRequestDto(query: ['page' => 1, 'limit' => 10]);
    $request = new GetDraftInvoicesRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultQuery');

    $query = $method->invoke($request);

    expect($query)->toBeArray()
        ->and($query)->toHaveKey('page')
        ->and($query)->toHaveKey('limit')
        ->and($query['page'])->toBe(1)
        ->and($query['limit'])->toBe(10);
});

test('defaultHeaders returns correct headers', function (): void {
    $dto = new GetDraftInvoicesRequestDto(query: []);
    $request = new GetDraftInvoicesRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');

    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers['Accept'])->toBe('application/json');
});
