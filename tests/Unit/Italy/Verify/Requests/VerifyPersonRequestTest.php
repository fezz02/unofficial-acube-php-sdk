<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\Verify\Dto\VerifyPersonRequestDto;
use Fezz\Acube\Sdk\Italy\Verify\Requests\VerifyPersonRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new VerifyPersonRequestDto(['fiscal_id' => 'RSSMRA80A01H501U']);
    $request = new VerifyPersonRequest($dto);

    expect($request->resolveEndpoint())->toBe('/verify/person');
});

test('createDtoFromResponse returns array', function (): void {
    $dto = new VerifyPersonRequestDto(['fiscal_id' => 'RSSMRA80A01H501U']);
    $request = new VerifyPersonRequest($dto);

    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new MockClient([
        MockResponse::make(['verified' => true], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);
    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeArray()
        ->and($result)->toHaveKey('verified');
});

test('defaultBody returns request body from dto', function (): void {
    $dto = new VerifyPersonRequestDto([
        'fiscal_id' => 'RSSMRA80A01H501U',
        'name' => 'Mario',
        'surname' => 'Rossi',
    ]);

    $request = new VerifyPersonRequest($dto);

    // Use reflection to access protected method
    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultBody');

    $body = $method->invoke($request);

    expect($body)->toBeArray()
        ->and($body)->toHaveKey('fiscal_id')
        ->and($body)->toHaveKey('name')
        ->and($body)->toHaveKey('surname')
        ->and($body['fiscal_id'])->toBe('RSSMRA80A01H501U')
        ->and($body['name'])->toBe('Mario')
        ->and($body['surname'])->toBe('Rossi');
});

test('defaultHeaders returns correct headers', function (): void {
    $dto = new VerifyPersonRequestDto(['fiscal_id' => 'RSSMRA80A01H501U']);
    $request = new VerifyPersonRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');
    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers['Accept'])->toBe('application/json')
        ->and($headers)->toHaveKey('Content-Type')
        ->and($headers['Content-Type'])->toBe('application/json');
});
