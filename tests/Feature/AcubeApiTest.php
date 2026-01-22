<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\AcubeApi;
use Fezz\Acube\Sdk\Authentication\AccessTokenAuthenticator;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Exceptions\Authentication\TokenNotFoundException;

beforeEach(function (): void {
});

test('acube api production method sets production endpoint', function (): void {
    $connector = AcubeApi::common(Endpoint::COMMON_PRODUCTION);
    expect($connector->resolveBaseUrl())->toBe('https://common.api.acubeapi.com');

    $connector2 = AcubeApi::common(Endpoint::COMMON_SANDBOX);
    expect($connector2->resolveBaseUrl())->toBe('https://common-sandbox.api.acubeapi.com');
});


test('login request createDtoFromResponse creates dto', function (): void {
    $connector = AcubeApi::common();
    $authApi = $connector->authentication();

    $mockClient = new Saloon\Http\Faking\MockClient([
        Saloon\Http\Faking\MockResponse::make(['token' => 'test-token'], 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $authApi->login('test@example.com', 'password123');
    $loginResponse = $response->dto();

    expect($loginResponse)
        ->toBeInstanceOf(Fezz\Acube\Sdk\Common\Authentication\Dto\LoginResponseDto::class)
        ->and($loginResponse->token)->toBe('test-token');
});
