<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\AcubeApi;
use Fezz\Acube\Sdk\Authentication\AccessTokenAuthenticator;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Tests\Fixtures\Authentication\_UnsafeInMemoryTokenCache as UnsafeInMemoryTokenCache;
use Fezz\Acube\Sdk\Common\CommonConnector;

beforeEach(function (): void {
    // Reset state before each test
});

test('common connector sandbox method sets endpoint', function (): void {
    $connector = AcubeApi::common(Endpoint::COMMON_SANDBOX);
    expect($connector->resolveBaseUrl())->toBe('https://common-sandbox.api.acubeapi.com');

    $connector2 = AcubeApi::common(Endpoint::COMMON_PRODUCTION);
    expect($connector2->resolveBaseUrl())->toBe('https://common.api.acubeapi.com');
});

test('common connector user method returns user api', function (): void {
    $connector = AcubeApi::common();
    $userApi = $connector->user();

    expect($userApi)->toBeInstanceOf(Fezz\Acube\Sdk\Common\User\Api::class);
});


test('common connector authentication method returns api instance', function (): void {
    $connector = AcubeApi::common();
    $authApi = $connector->authentication();

    expect($authApi)->toBeInstanceOf(Fezz\Acube\Sdk\Common\Authentication\Api::class);
});

test('common connector subscriptions method returns subscriptions api', function (): void {
    $connector = AcubeApi::common();
    $subscriptionsApi = $connector->subscriptions();

    expect($subscriptionsApi)->toBeInstanceOf(Fezz\Acube\Sdk\Common\Subscriptions\Api::class);
});

test('common connector preSales method returns pre sales api', function (): void {
    $connector = AcubeApi::common();
    $preSalesApi = $connector->preSales();

    expect($preSalesApi)->toBeInstanceOf(Fezz\Acube\Sdk\Common\PreSales\Api::class);
});

test('common connector preSaleActions method returns pre sale actions api', function (): void {
    $connector = AcubeApi::common();
    $preSaleActionsApi = $connector->preSaleActions();

    expect($preSaleActionsApi)->toBeInstanceOf(Fezz\Acube\Sdk\Common\PreSaleActions\Api::class);
});
