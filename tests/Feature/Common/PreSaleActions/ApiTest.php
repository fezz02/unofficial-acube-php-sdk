<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\AcubeApi;
use Fezz\Acube\Sdk\Common\PreSaleActions\Dto\CreatePreSaleActionRequestDto;
use Fezz\Acube\Sdk\Common\PreSaleActions\Dto\GetPreSaleActionsResponseDto;
use Fezz\Acube\Sdk\Common\PreSaleActions\Dto\PreSaleActionDto;
use Fezz\Acube\Sdk\Common\PreSaleActions\Dto\UpdatePreSaleActionRequestDto;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function (): void {
});

test('can list pre sale actions', function (): void {
    $connector = AcubeApi::common();
    $preSaleActionsApi = $connector->preSaleActions();

    $mockData = [
        [
            'uuid' => 'action-123',
            'created_at' => '2024-01-01T00:00:00Z',
            'updated_at' => '2024-01-02T00:00:00Z',
            'threshold' => 100,
            'action_type' => 'alert_mail',
            'target' => 'admin@example.com',
            'enabled' => true,
            'running' => false,
            'pre_sale_uuid' => 'presale-123',
        ],
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $requestDto = new Fezz\Acube\Sdk\Common\PreSaleActions\Dto\GetPreSaleActionsRequestDto(query: []);
    $response = $preSaleActionsApi->list($requestDto);
    $dto = $response->dto();

    expect($dto)
        ->toBeInstanceOf(GetPreSaleActionsResponseDto::class)
        ->and($dto->preSaleActions)->toHaveCount(1)
        ->and($dto->preSaleActions[0])->toBeInstanceOf(PreSaleActionDto::class)
        ->and($dto->preSaleActions[0]->uuid)->toBe('action-123')
        ->and($dto->preSaleActions[0]->threshold)->toBe(100)
        ->and($dto->preSaleActions[0]->enabled)->toBeTrue();
});

test('can get pre sale action by uuid', function (): void {
    $connector = AcubeApi::common();
    $preSaleActionsApi = $connector->preSaleActions();

    $mockData = [
        'uuid' => 'action-456',
        'created_at' => '2024-02-01T00:00:00Z',
        'updated_at' => '2024-02-02T00:00:00Z',
        'threshold' => 200,
        'action_type' => 'alert_mail',
        'target' => 'user@example.com',
        'enabled' => false,
        'running' => true,
        'pre_sale_uuid' => 'presale-456',
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $preSaleActionsApi->get('action-456');
    $dto = $response->dto();

    expect($dto)
        ->toBeInstanceOf(PreSaleActionDto::class)
        ->and($dto->uuid)->toBe('action-456')
        ->and($dto->threshold)->toBe(200)
        ->and($dto->enabled)->toBeFalse()
        ->and($dto->running)->toBeTrue();
});

test('can create pre sale action', function (): void {
    $connector = AcubeApi::common();
    $preSaleActionsApi = $connector->preSaleActions();

    $requestDto = new CreatePreSaleActionRequestDto(
        threshold: 300,
        action_type: 'alert_mail',
        target: 'new@example.com',
        enabled: true,
        pre_sale_uuid: 'presale-789'
    );

    $mockData = [
        'uuid' => 'action-789',
        'created_at' => '2024-03-01T00:00:00Z',
        'updated_at' => '2024-03-01T00:00:00Z',
        'threshold' => 300,
        'action_type' => 'alert_mail',
        'target' => 'new@example.com',
        'enabled' => true,
        'running' => false,
        'pre_sale_uuid' => 'presale-789',
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 201),
    ]);

    $connector->withMockClient($mockClient);

    $response = $preSaleActionsApi->create($requestDto);
    $dto = $response->dto();

    expect($response->status())->toBe(201)
        ->and($dto)->toBeInstanceOf(PreSaleActionDto::class)
        ->and($dto->uuid)->toBe('action-789')
        ->and($dto->threshold)->toBe(300);
});

test('can update pre sale action', function (): void {
    $connector = AcubeApi::common();
    $preSaleActionsApi = $connector->preSaleActions();

    $requestDto = new UpdatePreSaleActionRequestDto(
        threshold: 400,
        action_type: 'alert_mail',
        target: 'updated@example.com',
        enabled: false,
        pre_sale_uuid: 'presale-999'
    );

    $mockData = [
        'uuid' => 'action-999',
        'created_at' => '2024-04-01T00:00:00Z',
        'updated_at' => '2024-04-02T00:00:00Z',
        'threshold' => 400,
        'action_type' => 'alert_mail',
        'target' => 'updated@example.com',
        'enabled' => false,
        'running' => false,
        'pre_sale_uuid' => 'presale-999',
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $preSaleActionsApi->update('action-999', $requestDto);
    $dto = $response->dto();

    expect($dto)
        ->toBeInstanceOf(PreSaleActionDto::class)
        ->and($dto->threshold)->toBe(400)
        ->and($dto->enabled)->toBeFalse();
});

test('can delete pre sale action', function (): void {
    $connector = AcubeApi::common();
    $preSaleActionsApi = $connector->preSaleActions();

    $mockClient = new MockClient([
        MockResponse::make([], 204),
    ]);

    $connector->withMockClient($mockClient);

    $response = $preSaleActionsApi->delete('action-123');

    expect($response->status())->toBe(204);
});

test('pre sale action dto can be created from array', function (): void {
    $data = [
        'uuid' => 'action-test',
        'created_at' => '2024-01-01T00:00:00Z',
        'updated_at' => '2024-01-02T00:00:00Z',
        'threshold' => 500,
        'action_type' => 'alert_mail',
        'target' => 'test@example.com',
        'enabled' => true,
        'running' => false,
        'pre_sale_uuid' => 'presale-test',
    ];

    $dto = PreSaleActionDto::from($data);

    expect($dto)
        ->toBeInstanceOf(PreSaleActionDto::class)
        ->and($dto->uuid)->toBe('action-test')
        ->and($dto->threshold)->toBe(500)
        ->and($dto->action_type)->toBe('alert_mail');
});

test('get pre sale actions response dto can handle empty array', function (): void {
    $dto = GetPreSaleActionsResponseDto::from([]);

    expect($dto)
        ->toBeInstanceOf(GetPreSaleActionsResponseDto::class)
        ->and($dto->preSaleActions)->toHaveCount(0);
});

test('get pre sale actions response dto can be created from array', function (): void {
    $data = [
        [
            'uuid' => 'action-1',
            'created_at' => '2024-01-01T00:00:00Z',
            'updated_at' => '2024-01-02T00:00:00Z',
            'threshold' => 100,
            'action_type' => 'alert_mail',
            'target' => 'test@example.com',
            'enabled' => true,
            'running' => false,
            'pre_sale_uuid' => 'presale-1',
        ],
    ];

    $dto = GetPreSaleActionsResponseDto::from($data);

    expect($dto)
        ->toBeInstanceOf(GetPreSaleActionsResponseDto::class)
        ->and($dto->preSaleActions)->toHaveCount(1)
        ->and($dto->preSaleActions[0]->uuid)->toBe('action-1');
});

test('create pre sale action request dto can be created', function (): void {
    $dto = new CreatePreSaleActionRequestDto(
        threshold: 200,
        action_type: 'alert_mail',
        target: 'target@example.com',
        enabled: true,
        pre_sale_uuid: 'presale-123'
    );

    expect($dto)
        ->toBeInstanceOf(CreatePreSaleActionRequestDto::class)
        ->and($dto->threshold)->toBe(200)
        ->and($dto->action_type)->toBe('alert_mail');
});

test('update pre sale action request dto can be created', function (): void {
    $dto = new UpdatePreSaleActionRequestDto(
        threshold: 300,
        action_type: 'alert_mail',
        target: 'updated@example.com',
        enabled: false,
        pre_sale_uuid: 'presale-456'
    );

    expect($dto)
        ->toBeInstanceOf(UpdatePreSaleActionRequestDto::class)
        ->and($dto->threshold)->toBe(300)
        ->and($dto->enabled)->toBeFalse();
});
