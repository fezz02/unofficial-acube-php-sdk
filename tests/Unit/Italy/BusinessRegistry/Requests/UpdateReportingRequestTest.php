<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\ReportingDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\UpdateReportingRequestDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\UpdateReportingRequest;
use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new UpdateReportingRequestDto(
        rejected_invoices_alert_schedule: ['daily' => true],
    );
    $request = new UpdateReportingRequest('12345678901', $dto);

    expect($request->resolveEndpoint())->toBe('/business-registry-configurations/12345678901/reporting');
});

test('createDtoFromResponse returns ReportingDto', function (): void {
    $dto = new UpdateReportingRequestDto(
        rejected_invoices_alert_schedule: ['daily' => true],
    );
    $request = new UpdateReportingRequest('12345678901', $dto);

    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new MockClient([
        MockResponse::make([
            'rejected_invoices_alert_schedule' => ['daily' => true],
        ], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);
    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeInstanceOf(ReportingDto::class);
});

test('defaultBody returns correct body', function (): void {
    $dto = new UpdateReportingRequestDto(
        rejected_invoices_alert_schedule: ['daily' => true, 'time' => '09:00'],
    );
    $request = new UpdateReportingRequest('12345678901', $dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultBody');
    $body = $method->invoke($request);

    expect($body)->toBeArray()
        ->and($body['rejected_invoices_alert_schedule'])->toBeArray()
        ->and($body['rejected_invoices_alert_schedule']['daily'])->toBeTrue();
});

