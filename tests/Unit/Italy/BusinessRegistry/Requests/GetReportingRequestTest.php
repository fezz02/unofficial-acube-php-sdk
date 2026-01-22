<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\ReportingDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\GetReportingRequest;
use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('resolveEndpoint returns correct path', function (): void {
    $request = new GetReportingRequest('12345678901');

    expect($request->resolveEndpoint())->toBe('/business-registry-configurations/12345678901/reporting');
});

test('createDtoFromResponse returns ReportingDto', function (): void {
    $request = new GetReportingRequest('12345678901');

    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new MockClient([
        MockResponse::make([
            'rejected_invoices_alert_schedule' => ['daily' => true],
        ], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);
    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeInstanceOf(ReportingDto::class)
        ->and($result->rejected_invoices_alert_schedule)->toBeArray();
});

