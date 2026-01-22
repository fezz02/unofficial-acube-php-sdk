<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\User\Dto\GetRecipientCodeRequestDto;
use Fezz\Acube\Sdk\Italy\User\Requests\GetRecipientCodeRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new GetRecipientCodeRequestDto(id: 'user-123');
    $request = new GetRecipientCodeRequest($dto);

    expect($request->resolveEndpoint())->toBe('/users/user-123/recipient-code');
});

test('createDtoFromResponse returns array', function (): void {
    $dto = new GetRecipientCodeRequestDto(id: 'user-123');
    $request = new GetRecipientCodeRequest($dto);

    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new MockClient([
        MockResponse::make(['recipient_code' => 'ABCDEFG'], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);
    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeArray()
        ->and($result)->toHaveKey('recipient_code')
        ->and($result['recipient_code'])->toBe('ABCDEFG');
});

test('defaultHeaders returns correct headers', function (): void {
    $dto = new GetRecipientCodeRequestDto(id: 'user-123');
    $request = new GetRecipientCodeRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');
    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers['Accept'])->toBe('application/json');
});
