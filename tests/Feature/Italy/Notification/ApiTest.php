<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\Notification\Api;
use Fezz\Acube\Sdk\Italy\Notification\Dto\GetNotificationRequestDto;
use Fezz\Acube\Sdk\Italy\Notification\Dto\MarkNotificationsDownloadedRequestDto;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function (): void {
});

test('get notification by uuid', function (): void {
    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $api = new Api($connector);

    $mockClient = new MockClient([
        MockResponse::make([
            'uuid' => 'notification-123',
            'invoice_uuid' => 'invoice-456',
            'created_at' => '2024-01-01T00:00:00Z',
            'type' => 'NS',
            'file_name' => 'notification.xml',
            'message' => '{}',
            'downloaded' => false,
            'downloaded_at' => null,
        ], 200),
    ]);

    $connector->withMockClient($mockClient);

    $dto = new GetNotificationRequestDto('notification-123');
    $response = $api->get($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('mark notifications as downloaded', function (): void {
    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $api = new Api($connector);

    $mockClient = new MockClient([
        MockResponse::make(['message' => 'Notifications marked as downloaded'], 200),
    ]);

    $connector->withMockClient($mockClient);

    $dto = new MarkNotificationsDownloadedRequestDto(['notification-123', 'notification-456']);
    $response = $api->markDownloaded($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});
