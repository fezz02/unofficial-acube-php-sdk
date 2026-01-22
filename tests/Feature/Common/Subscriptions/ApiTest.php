<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\AcubeApi;
use Fezz\Acube\Sdk\Common\Subscriptions\Dto\GetSubscriptionsResponseDto;
use Fezz\Acube\Sdk\Common\Subscriptions\Dto\SubscriptionDto;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function (): void {
});

test('can list subscriptions', function (): void {
    $connector = AcubeApi::common();
    $subscriptionsApi = $connector->subscriptions();

    $mockData = [
        [
            'uuid' => 'sub-123',
            'project_codename' => 'project1',
            'fiscal_id' => 'ABC123',
            'active' => true,
            'period_starts_at' => '2024-01-01T00:00:00Z',
            'period_ends_at' => '2024-12-31T23:59:59Z',
            'auto_renew' => true,
            'auto_renew_at' => '2024-12-31T23:59:59Z',
            'limit' => 1000,
            'count' => 500,
            'deleted' => false,
        ],
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $requestDto = new Fezz\Acube\Sdk\Common\Subscriptions\Dto\GetSubscriptionsRequestDto(query: []);
    $response = $subscriptionsApi->list($requestDto);
    $dto = $response->dto();

    expect($dto)
        ->toBeInstanceOf(GetSubscriptionsResponseDto::class)
        ->and($dto->subscriptions)->toHaveCount(1)
        ->and($dto->subscriptions[0])->toBeInstanceOf(SubscriptionDto::class)
        ->and($dto->subscriptions[0]->uuid)->toBe('sub-123')
        ->and($dto->subscriptions[0]->project_codename)->toBe('project1')
        ->and($dto->subscriptions[0]->active)->toBeTrue();
});

test('can list subscriptions with query parameters', function (): void {
    $connector = AcubeApi::common();
    $subscriptionsApi = $connector->subscriptions();

    $mockClient = new MockClient([
        MockResponse::make([], 200),
    ]);

    $connector->withMockClient($mockClient);

    $requestDto = new Fezz\Acube\Sdk\Common\Subscriptions\Dto\GetSubscriptionsRequestDto(query: ['page' => 2, 'active' => true]);
    $response = $subscriptionsApi->list($requestDto);
    $dto = $response->dto();

    expect($dto)
        ->toBeInstanceOf(GetSubscriptionsResponseDto::class)
        ->and($dto->subscriptions)->toHaveCount(0);
});

test('can get subscription by uuid', function (): void {
    $connector = AcubeApi::common();
    $subscriptionsApi = $connector->subscriptions();

    $mockData = [
        'uuid' => 'sub-456',
        'project_codename' => 'project2',
        'fiscal_id' => 'DEF456',
        'active' => false,
        'period_starts_at' => '2024-01-01T00:00:00Z',
        'period_ends_at' => '2024-12-31T23:59:59Z',
        'auto_renew' => false,
        'auto_renew_at' => '2024-12-31T23:59:59Z',
        'limit' => 2000,
        'count' => 1500,
        'deleted' => false,
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $requestDto = new Fezz\Acube\Sdk\Common\Subscriptions\Dto\GetSubscriptionRequestDto(uuid: 'sub-456');
    $response = $subscriptionsApi->get($requestDto);
    $dto = $response->dto();

    expect($dto)
        ->toBeInstanceOf(SubscriptionDto::class)
        ->and($dto->uuid)->toBe('sub-456')
        ->and($dto->project_codename)->toBe('project2')
        ->and($dto->active)->toBeFalse();
});

test('subscription dto can be created from array', function (): void {
    $data = [
        'uuid' => 'sub-789',
        'project_codename' => 'project3',
        'fiscal_id' => 'GHI789',
        'active' => true,
        'period_starts_at' => '2024-01-01T00:00:00Z',
        'period_ends_at' => '2024-12-31T23:59:59Z',
        'auto_renew' => true,
        'auto_renew_at' => '2024-12-31T23:59:59Z',
        'limit' => 5000,
        'count' => 3000,
        'deleted' => false,
    ];

    $dto = SubscriptionDto::from($data);

    expect($dto)
        ->toBeInstanceOf(SubscriptionDto::class)
        ->and($dto->uuid)->toBe('sub-789')
        ->and($dto->limit)->toBe(5000)
        ->and($dto->count)->toBe(3000)
        ->and($dto->deleted)->toBeFalse();
});

test('get subscriptions response dto can handle empty array', function (): void {
    $dto = GetSubscriptionsResponseDto::from([]);

    expect($dto)
        ->toBeInstanceOf(GetSubscriptionsResponseDto::class)
        ->and($dto->subscriptions)->toHaveCount(0);
});

test('get subscriptions response dto can be created from array', function (): void {
    $data = [
        [
            'uuid' => 'sub-1',
            'project_codename' => 'project1',
            'fiscal_id' => 'FISCAL1',
            'active' => true,
            'period_starts_at' => '2024-01-01T00:00:00Z',
            'period_ends_at' => '2024-12-31T23:59:59Z',
            'auto_renew' => true,
            'auto_renew_at' => '2024-12-31T23:59:59Z',
            'limit' => 100,
            'count' => 50,
            'deleted' => false,
        ],
    ];

    $dto = GetSubscriptionsResponseDto::from($data);

    expect($dto)
        ->toBeInstanceOf(GetSubscriptionsResponseDto::class)
        ->and($dto->subscriptions)->toHaveCount(1)
        ->and($dto->subscriptions[0]->uuid)->toBe('sub-1');
});

test('can create subscription (admin)', function (): void {
    $connector = AcubeApi::common();
    $subscriptionsApi = $connector->subscriptions();

    $mockData = [
        'uuid' => 'sub-new',
        'project_codename' => 'project-new',
        'fiscal_id' => 'NEW123',
        'active' => true,
        'period_starts_at' => '2024-01-01T00:00:00Z',
        'period_ends_at' => '2024-12-31T23:59:59Z',
        'auto_renew' => true,
        'auto_renew_at' => '2024-12-31T23:59:59Z',
        'limit' => 1000,
        'count' => 0,
        'deleted' => false,
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 201),
    ]);

    $connector->withMockClient($mockClient);

    $requestDto = new Fezz\Acube\Sdk\Common\Subscriptions\Dto\CreateSubscriptionRequestDto(
        project_codename: 'project-new',
        limit: 1000,
        active: true,
        auto_renew: true,
        duration: '1Y',
        fiscal_id: 'NEW123'
    );
    $response = $subscriptionsApi->create($requestDto);
    $dto = $response->dto();

    expect($dto)
        ->toBeInstanceOf(SubscriptionDto::class)
        ->and($dto->uuid)->toBe('sub-new')
        ->and($dto->project_codename)->toBe('project-new');
});

test('can update subscription (admin)', function (): void {
    $connector = AcubeApi::common();
    $subscriptionsApi = $connector->subscriptions();

    $mockData = [
        'uuid' => 'sub-updated',
        'project_codename' => 'project-updated',
        'fiscal_id' => 'UPD123',
        'active' => false,
        'period_starts_at' => '2024-01-01T00:00:00Z',
        'period_ends_at' => '2024-12-31T23:59:59Z',
        'auto_renew' => false,
        'auto_renew_at' => null,
        'limit' => 2000,
        'count' => 100,
        'deleted' => false,
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $requestDto = new Fezz\Acube\Sdk\Common\Subscriptions\Dto\UpdateSubscriptionRequestDto(
        uuid: 'sub-updated',
        limit: 2000,
        active: false,
        auto_renew: false
    );
    $response = $subscriptionsApi->update($requestDto);
    $dto = $response->dto();

    expect($dto)
        ->toBeInstanceOf(SubscriptionDto::class)
        ->and($dto->uuid)->toBe('sub-updated')
        ->and($dto->active)->toBeFalse()
        ->and($dto->limit)->toBe(2000);
});

test('can delete subscription (admin)', function (): void {
    $connector = AcubeApi::common();
    $subscriptionsApi = $connector->subscriptions();

    $mockClient = new MockClient([
        MockResponse::make([], 204),
    ]);

    $connector->withMockClient($mockClient);

    $requestDto = new Fezz\Acube\Sdk\Common\Subscriptions\Dto\DeleteSubscriptionRequestDto(uuid: 'sub-delete');
    $response = $subscriptionsApi->delete($requestDto);

    expect($response->status())->toBe(204);
});

test('can renew subscription (admin)', function (): void {
    $connector = AcubeApi::common();
    $subscriptionsApi = $connector->subscriptions();

    $mockData = [
        'uuid' => 'sub-renewed',
        'project_codename' => 'project-renewed',
        'fiscal_id' => 'REN123',
        'active' => true,
        'period_starts_at' => '2025-01-01T00:00:00Z',
        'period_ends_at' => '2025-12-31T23:59:59Z',
        'auto_renew' => true,
        'auto_renew_at' => '2025-12-31T23:59:59Z',
        'limit' => 1000,
        'count' => 0,
        'deleted' => false,
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 201),
    ]);

    $connector->withMockClient($mockClient);

    $requestDto = new Fezz\Acube\Sdk\Common\Subscriptions\Dto\RenewSubscriptionRequestDto(uuid: 'sub-renewed');
    $response = $subscriptionsApi->renew($requestDto);
    $dto = $response->dto();

    expect($dto)
        ->toBeInstanceOf(SubscriptionDto::class)
        ->and($dto->uuid)->toBe('sub-renewed')
        ->and($dto->active)->toBeTrue();
});
