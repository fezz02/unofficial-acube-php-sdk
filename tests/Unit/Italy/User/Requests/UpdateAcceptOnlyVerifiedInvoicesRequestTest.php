<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\User\Dto\UpdateAcceptOnlyVerifiedInvoicesRequestDto;
use Fezz\Acube\Sdk\Italy\User\Requests\UpdateAcceptOnlyVerifiedInvoicesRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new UpdateAcceptOnlyVerifiedInvoicesRequestDto(id: 'user-123', user: []);
    $request = new UpdateAcceptOnlyVerifiedInvoicesRequest($dto);

    expect($request->resolveEndpoint())->toBe('/users/user-123/accept-only-verified-invoices');
});

test('createDtoFromResponse returns array', function (): void {
    $dto = new UpdateAcceptOnlyVerifiedInvoicesRequestDto(id: 'user-123', user: ['accept_only_verified_invoices' => true]);
    $request = new UpdateAcceptOnlyVerifiedInvoicesRequest($dto);

    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new MockClient([
        MockResponse::make(['accept_only_verified_invoices' => true], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);
    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeArray()
        ->and($result)->toHaveKey('accept_only_verified_invoices')
        ->and($result['accept_only_verified_invoices'])->toBeTrue();
});

test('defaultBody returns user data from DTO', function (): void {
    $userData = ['accept_only_verified_invoices' => true];
    $dto = new UpdateAcceptOnlyVerifiedInvoicesRequestDto(id: 'user-123', user: $userData);
    $request = new UpdateAcceptOnlyVerifiedInvoicesRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultBody');
    $body = $method->invoke($request);

    expect($body)->toBeArray()
        ->and($body)->toBe($userData);
});

test('defaultHeaders returns correct headers', function (): void {
    $dto = new UpdateAcceptOnlyVerifiedInvoicesRequestDto(id: 'user-123', user: []);
    $request = new UpdateAcceptOnlyVerifiedInvoicesRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');
    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers['Accept'])->toBe('application/json')
        ->and($headers)->toHaveKey('Content-Type')
        ->and($headers['Content-Type'])->toBe('application/json');
});
