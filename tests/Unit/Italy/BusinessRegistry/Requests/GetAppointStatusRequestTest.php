<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\AppointStatusDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\GetAppointStatusRequest;
use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('resolveEndpoint returns correct path', function (): void {
    $request = new GetAppointStatusRequest('12345678901');

    expect($request->resolveEndpoint())->toBe('/business-registry-configurations/12345678901/appoint/status');
});

test('createDtoFromResponse returns AppointStatusDto', function (): void {
    $request = new GetAppointStatusRequest('12345678901');

    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new MockClient([
        MockResponse::make([
            'receipt_enabled' => true,
            'status' => 'completed',
            'appointee' => 'A-CUBE',
        ], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);
    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeInstanceOf(AppointStatusDto::class)
        ->and($result->receipt_enabled)->toBeTrue()
        ->and($result->status)->toBe('completed');
});

