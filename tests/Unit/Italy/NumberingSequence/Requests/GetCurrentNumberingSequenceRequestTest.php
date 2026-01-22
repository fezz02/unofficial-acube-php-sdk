<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\NumberingSequence\Dto\GetCurrentNumberingSequenceRequestDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\NumberingSequence\Dto\NumberingSequenceDto;
use Fezz\Acube\Sdk\Italy\NumberingSequence\Requests\GetCurrentNumberingSequenceRequest;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new GetCurrentNumberingSequenceRequestDto(name: 'invoice');
    $request = new GetCurrentNumberingSequenceRequest($dto);

    expect($request->resolveEndpoint())->toBe('/numbering-sequences/current/invoice');
});

test('createDtoFromResponse returns NumberingSequenceDto', function (): void {
    $dto = new GetCurrentNumberingSequenceRequestDto(name: 'invoice');
    $request = new GetCurrentNumberingSequenceRequest($dto);

    $connector = new Fezz\Acube\Sdk\Italy\ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new Saloon\Http\Faking\MockClient([
        Saloon\Http\Faking\MockResponse::make([
            'name' => 'invoice',
            'format' => 'INV-%Y-%04d',
            'number' => 42,
        ], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);

    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeInstanceOf(NumberingSequenceDto::class);
});

test('defaultHeaders returns correct headers', function (): void {
    $dto = new GetCurrentNumberingSequenceRequestDto(name: 'invoice');
    $request = new GetCurrentNumberingSequenceRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');

    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers['Accept'])->toBe('application/json');
});
