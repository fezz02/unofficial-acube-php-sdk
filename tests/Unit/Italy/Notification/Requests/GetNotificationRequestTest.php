<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\Notification\Dto\GetNotificationRequestDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\Notification\Dto\NotificationDto;
use Fezz\Acube\Sdk\Italy\Notification\Requests\GetNotificationRequest;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new GetNotificationRequestDto(uuid: 'notification-123');
    $request = new GetNotificationRequest($dto);

    expect($request->resolveEndpoint())->toBe('/notifications/notification-123');
});

test('createDtoFromResponse returns NotificationDto for JSON response', function (): void {
    $dto = new GetNotificationRequestDto(uuid: 'notification-123');
    $request = new GetNotificationRequest($dto);

    $connector = new Fezz\Acube\Sdk\Italy\ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new Saloon\Http\Faking\MockClient([
        Saloon\Http\Faking\MockResponse::make([
            'uuid' => 'notification-123',
            'type' => 'NS',
        ], 200, ['Content-Type' => 'application/json']),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);

    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeInstanceOf(NotificationDto::class);
});

test('createDtoFromResponse returns NotificationDto for JSON response with array Content-Type', function (): void {
    $dto = new GetNotificationRequestDto(uuid: 'notification-123');
    $request = new GetNotificationRequest($dto);

    // Create a mock response that returns array for Content-Type header to test lines 58-59
    $connector = new Fezz\Acube\Sdk\Italy\ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new Saloon\Http\Faking\MockClient([
        Saloon\Http\Faking\MockResponse::make([
            'uuid' => 'notification-123',
            'type' => 'NS',
        ], 200, ['Content-Type' => 'application/json']),
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

    expect($result)->toBeInstanceOf(NotificationDto::class);
});

test('createDtoFromResponse returns string for XML response', function (): void {
    $dto = new GetNotificationRequestDto(uuid: 'notification-123');
    $request = new GetNotificationRequest($dto);

    $connector = new Fezz\Acube\Sdk\Italy\ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new Saloon\Http\Faking\MockClient([
        Saloon\Http\Faking\MockResponse::make('<xml>test</xml>', 200, ['Content-Type' => 'application/xml']),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);

    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeString()
        ->and($result)->toBe('<xml>test</xml>');
});

test('defaultHeaders returns correct headers', function (): void {
    $dto = new GetNotificationRequestDto(uuid: 'notification-123');
    $request = new GetNotificationRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');

    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers['Accept'])->toBe('application/json');
});
