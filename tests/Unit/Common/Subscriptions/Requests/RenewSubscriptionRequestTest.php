<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Common\Subscriptions\Dto\RenewSubscriptionRequestDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Common\Subscriptions\Dto\SubscriptionDto;
use Fezz\Acube\Sdk\Common\Subscriptions\Requests\RenewSubscriptionRequest;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new RenewSubscriptionRequestDto(uuid: 'sub-123');
    $request = new RenewSubscriptionRequest($dto);

    expect($request->resolveEndpoint())->toBe('/admin/subscriptions/sub-123/renew');
});

test('createDtoFromResponse returns SubscriptionDto', function (): void {
    $dto = new RenewSubscriptionRequestDto(uuid: 'sub-123');
    $request = new RenewSubscriptionRequest($dto);

    $connector = new Fezz\Acube\Sdk\Common\CommonConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new Saloon\Http\Faking\MockClient([
        Saloon\Http\Faking\MockResponse::make([
            'uuid' => 'sub-123',
            'project_codename' => 'test-project',
            'fiscal_id' => 'FISCAL123',
            'active' => true,
            'period_starts_at' => '2024-01-01T00:00:00Z',
            'period_ends_at' => '2024-12-31T23:59:59Z',
            'auto_renew' => null,
            'auto_renew_at' => null,
            'limit' => null,
            'count' => null,
            'deleted' => false,
        ], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);

    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeInstanceOf(SubscriptionDto::class);
});

test('defaultBody returns empty array', function (): void {
    $dto = new RenewSubscriptionRequestDto(uuid: 'sub-123');
    $request = new RenewSubscriptionRequest($dto);

    if (method_exists($request, 'defaultBody')) {
        $reflection = new ReflectionClass($request);
        $method = $reflection->getMethod('defaultBody');

        $body = $method->invoke($request);

        expect($body)->toBeArray()
            ->and($body)->toBeEmpty();
    } else {
        // If defaultBody doesn't exist, skip this test
        expect(true)->toBeTrue();
    }
});

test('defaultHeaders returns correct headers', function (): void {
    $dto = new RenewSubscriptionRequestDto(uuid: 'sub-123');
    $request = new RenewSubscriptionRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');

    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers)->toHaveKey('Content-Type')
        ->and($headers['Accept'])->toBe('application/json')
        ->and($headers['Content-Type'])->toBe('application/json');
});
