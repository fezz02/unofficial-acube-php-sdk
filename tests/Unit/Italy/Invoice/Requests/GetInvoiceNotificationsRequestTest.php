<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\Invoice\Dto\GetInvoiceNotificationsRequestDto;
use Fezz\Acube\Sdk\Italy\Invoice\Requests\GetInvoiceNotificationsRequest;

test('createDtoFromResponse returns array of notifications', function (): void {
    $dto = new GetInvoiceNotificationsRequestDto(uuid: 'invoice-uuid-123');
    $request = new GetInvoiceNotificationsRequest($dto);

    $connector = new Fezz\Acube\Sdk\Italy\ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new Saloon\Http\Faking\MockClient([
        Saloon\Http\Faking\MockResponse::make([
            [
                'uuid' => 'notification-1',
                'type' => 'NS',
            ],
        ], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);

    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeArray()
        ->and($result)->toHaveCount(1)
        ->and($result[0])->toHaveKey('uuid');
});

test('defaultHeaders returns correct headers', function (): void {
    $dto = new GetInvoiceNotificationsRequestDto(uuid: 'invoice-uuid-123');
    $request = new GetInvoiceNotificationsRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');

    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers['Accept'])->toBe('application/json');
});
