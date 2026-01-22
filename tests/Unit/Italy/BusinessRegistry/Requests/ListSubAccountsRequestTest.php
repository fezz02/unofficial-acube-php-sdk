<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\SubAccountDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\ListSubAccountsRequest;
use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('resolveEndpoint returns correct path', function (): void {
    $request = new ListSubAccountsRequest('12345678901');

    expect($request->resolveEndpoint())->toBe('/business-registry-configurations/12345678901/sub-accounts');
});

test('createDtoFromResponse returns array of SubAccountDto', function (): void {
    $request = new ListSubAccountsRequest('12345678901');

    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new MockClient([
        MockResponse::make([
            ['email' => 'sub1@example.com'],
            ['email' => 'sub2@example.com'],
        ], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);
    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeArray()
        ->and($result[0])->toBeInstanceOf(SubAccountDto::class)
        ->and($result[0]->email)->toBe('sub1@example.com');
});

