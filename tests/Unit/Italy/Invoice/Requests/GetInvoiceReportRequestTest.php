<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\Invoice\Dto\GetInvoiceReportRequestDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\Invoice\Requests\GetInvoiceReportRequest;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new GetInvoiceReportRequestDto(query: []);
    $request = new GetInvoiceReportRequest($dto);

    expect($request->resolveEndpoint())->toBe('/invoices/report');
});

test('createDtoFromResponse returns array for JSON response', function (): void {
    $dto = new GetInvoiceReportRequestDto(query: []);
    $request = new GetInvoiceReportRequest($dto);

    $connector = new Fezz\Acube\Sdk\Italy\ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new Saloon\Http\Faking\MockClient([
        Saloon\Http\Faking\MockResponse::make(['report' => 'data'], 200, ['Content-Type' => 'application/json']),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);

    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeArray()
        ->and($result)->toHaveKey('report');
});

test('createDtoFromResponse returns array for JSON response with array Content-Type', function (): void {
    $dto = new GetInvoiceReportRequestDto(query: []);
    $request = new GetInvoiceReportRequest($dto);

    // Create a mock response that returns array for Content-Type header to test lines 57-58
    $connector = new Fezz\Acube\Sdk\Italy\ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new Saloon\Http\Faking\MockClient([
        Saloon\Http\Faking\MockResponse::make(['report' => 'data'], 200, ['Content-Type' => 'application/json']),
    ]);
    $connector->withMockClient($mockClient);
    $realResponse = $connector->send($request);

    $reflection = new ReflectionClass($realResponse);
    $psrRequest = $reflection->getProperty('psrRequest');
    $psrResponse = $reflection->getProperty('psrResponse');
    $pendingRequest = $reflection->getProperty('pendingRequest');

    $mockResponse = new class($psrResponse->getValue($realResponse), $pendingRequest->getValue($realResponse), $psrRequest->getValue($realResponse)) extends Saloon\Http\Response
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
        ->and($result)->toHaveKey('report');
});

test('createDtoFromResponse returns string for non-JSON response', function (): void {
    $dto = new GetInvoiceReportRequestDto(query: []);
    $request = new GetInvoiceReportRequest($dto);

    $connector = new Fezz\Acube\Sdk\Italy\ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new Saloon\Http\Faking\MockClient([
        Saloon\Http\Faking\MockResponse::make('CSV content', 200, ['Content-Type' => 'text/csv']),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);

    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeString()
        ->and($result)->toBe('CSV content');
});

test('defaultQuery returns query parameters from dto', function (): void {
    $dto = new GetInvoiceReportRequestDto(query: ['format' => 'csv']);
    $request = new GetInvoiceReportRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultQuery');

    $query = $method->invoke($request);

    expect($query)->toBeArray()
        ->and($query)->toHaveKey('format')
        ->and($query['format'])->toBe('csv');
});

test('defaultHeaders returns correct headers', function (): void {
    $dto = new GetInvoiceReportRequestDto(query: []);
    $request = new GetInvoiceReportRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');

    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers['Accept'])->toBe('application/json');
});
