<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\NumberingSequence\Dto\NumberingSequenceDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\NumberingSequence\Dto\UpdateNumberingSequenceRequestDto;
use Fezz\Acube\Sdk\Italy\NumberingSequence\Requests\UpdateNumberingSequenceRequest;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new UpdateNumberingSequenceRequestDto(id: 'seq-123', sequence: ['name' => 'test']);
    $request = new UpdateNumberingSequenceRequest($dto);

    expect($request->resolveEndpoint())->toBe('/numbering-sequences/seq-123');
});

test('createDtoFromResponse returns NumberingSequenceDto', function (): void {
    $dto = new UpdateNumberingSequenceRequestDto(id: 'seq-123', sequence: ['name' => 'test']);
    $request = new UpdateNumberingSequenceRequest($dto);

    $connector = new Fezz\Acube\Sdk\Italy\ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new Saloon\Http\Faking\MockClient([
        Saloon\Http\Faking\MockResponse::make([
            'name' => 'test',
            'format' => 'INV-%Y-%04d',
            'number' => 42,
        ], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);

    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeInstanceOf(NumberingSequenceDto::class);
});

test('defaultBody returns sequence data', function (): void {
    $sequenceData = ['name' => 'test'];
    $dto = new UpdateNumberingSequenceRequestDto(id: 'seq-123', sequence: $sequenceData);
    $request = new UpdateNumberingSequenceRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultBody');

    $body = $method->invoke($request);

    expect($body)->toBe($sequenceData);
});

test('defaultHeaders returns correct headers', function (): void {
    $dto = new UpdateNumberingSequenceRequestDto(id: 'seq-123', sequence: ['name' => 'test']);
    $request = new UpdateNumberingSequenceRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');

    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers)->toHaveKey('Content-Type')
        ->and($headers['Accept'])->toBe('application/json')
        ->and($headers['Content-Type'])->toBe('application/json');
});
