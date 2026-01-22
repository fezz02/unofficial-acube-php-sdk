<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\AddSubAccountRequestDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\SubAccountDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\AddSubAccountRequest;
use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new AddSubAccountRequestDto(
        id: '12345678901',
        email: 'subaccount@example.com',
    );
    $request = new AddSubAccountRequest($dto);

    expect($request->resolveEndpoint())->toBe('/business-registry-configurations/12345678901/sub-accounts');
});

test('createDtoFromResponse returns SubAccountDto', function (): void {
    $dto = new AddSubAccountRequestDto(
        id: '12345678901',
        email: 'subaccount@example.com',
    );
    $request = new AddSubAccountRequest($dto);

    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new MockClient([
        MockResponse::make(['email' => 'subaccount@example.com'], 201),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);
    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeInstanceOf(SubAccountDto::class)
        ->and($result->email)->toBe('subaccount@example.com');
});

test('defaultBody returns correct body with password', function (): void {
    $dto = new AddSubAccountRequestDto(
        id: '12345678901',
        email: 'subaccount@example.com',
        password: 'password123',
    );
    $request = new AddSubAccountRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultBody');
    $body = $method->invoke($request);

    expect($body)->toBeArray()
        ->and($body['email'])->toBe('subaccount@example.com')
        ->and($body['password'])->toBe('password123');
});

test('defaultBody handles null password', function (): void {
    $dto = new AddSubAccountRequestDto(
        id: '12345678901',
        email: 'subaccount@example.com',
    );
    $request = new AddSubAccountRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultBody');
    $body = $method->invoke($request);

    expect($body)->toBeArray()
        ->and($body)->not->toHaveKey('password');
});

