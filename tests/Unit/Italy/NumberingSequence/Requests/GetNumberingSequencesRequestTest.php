<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\NumberingSequence\Dto\GetNumberingSequencesRequestDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\NumberingSequence\Dto\NumberingSequenceDto;
use Fezz\Acube\Sdk\Italy\NumberingSequence\Requests\GetNumberingSequencesRequest;

test('defaultQuery returns query parameters from dto', function (): void {
    $dto = new GetNumberingSequencesRequestDto(query: ['page' => 1, 'limit' => 10]);
    $request = new GetNumberingSequencesRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultQuery');

    $query = $method->invoke($request);

    expect($query)->toBeArray()
        ->and($query)->toHaveKey('page')
        ->and($query)->toHaveKey('limit')
        ->and($query['page'])->toBe(1)
        ->and($query['limit'])->toBe(10);
});

test('createDtoFromResponse returns array of NumberingSequenceDto', function (): void {
    $dto = new GetNumberingSequencesRequestDto(query: []);
    $request = new GetNumberingSequencesRequest($dto);

    $connector = new Fezz\Acube\Sdk\Italy\ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new Saloon\Http\Faking\MockClient([
        Saloon\Http\Faking\MockResponse::make([
            [
                'name' => 'Sequence 1',
                'format' => 'INV-%Y-%04d',
                'number' => 42,
            ],
        ], 200),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);

    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeArray()
        ->and($result)->toHaveCount(1)
        ->and($result[0])->toBeInstanceOf(NumberingSequenceDto::class);
});

test('defaultHeaders returns correct headers', function (): void {
    $dto = new GetNumberingSequencesRequestDto(query: []);
    $request = new GetNumberingSequencesRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultHeaders');

    $headers = $method->invoke($request);

    expect($headers)->toBeArray()
        ->and($headers)->toHaveKey('Accept')
        ->and($headers['Accept'])->toBe('application/json');
});
