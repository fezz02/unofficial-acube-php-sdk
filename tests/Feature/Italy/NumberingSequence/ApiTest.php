<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\AcubeApi;
use Fezz\Acube\Sdk\Italy\NumberingSequence\Dto\CreateNumberingSequenceRequestDto;
use Fezz\Acube\Sdk\Italy\NumberingSequence\Dto\DeleteNumberingSequenceRequestDto;
use Fezz\Acube\Sdk\Italy\NumberingSequence\Dto\GetCurrentNumberingSequenceRequestDto;
use Fezz\Acube\Sdk\Italy\NumberingSequence\Dto\GetNumberingSequenceRequestDto;
use Fezz\Acube\Sdk\Italy\NumberingSequence\Dto\GetNumberingSequencesRequestDto;
use Fezz\Acube\Sdk\Italy\NumberingSequence\Dto\UpdateCurrentNumberingSequenceRequestDto;
use Fezz\Acube\Sdk\Italy\NumberingSequence\Dto\UpdateNumberingSequenceRequestDto;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function (): void {
});

test('can create numbering sequence', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->numberingSequences();

    $dto = new CreateNumberingSequenceRequestDto(
        name: 'INV-2025',
        format: 'INV-{number}',
        number: 0
    );

    $mockData = [
        'name' => 'INV-2025',
        'format' => 'INV-{number}',
        'number' => 1,
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 201),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->create($dto);
    $responseDto = $response->dto();

    expect($responseDto)
        ->toBeInstanceOf(Fezz\Acube\Sdk\Italy\NumberingSequence\Dto\NumberingSequenceDto::class)
        ->and($responseDto->name)->toBe('INV-2025')
        ->and($responseDto->format)->toBe('INV-{number}')
        ->and($responseDto->number)->toBe(1);
});

test('can list numbering sequences', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->numberingSequences();

    $dto = new GetNumberingSequencesRequestDto([]);

    $mockData = [
        [
            'name' => 'INV-2025',
            'format' => 'INV-{number}',
            'number' => 1,
        ],
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->list($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('can get numbering sequence by id', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->numberingSequences();

    $dto = new GetNumberingSequenceRequestDto('seq-123');

    $mockData = [
        'name' => 'INV-2025',
        'format' => 'INV-{number}',
        'number' => 1,
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->get($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('can update numbering sequence', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->numberingSequences();

    $dto = new UpdateNumberingSequenceRequestDto('seq-123', [
        'name' => 'INV-2026',
        'format' => 'INV-{number}',
        'number' => 10,
    ]);

    $mockData = [
        'name' => 'INV-2026',
        'format' => 'INV-{number}',
        'number' => 10,
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->update($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('can delete numbering sequence', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->numberingSequences();

    $dto = new DeleteNumberingSequenceRequestDto('seq-123');

    $mockClient = new MockClient([
        MockResponse::make('', 204),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->delete($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(204);
});

test('can get current numbering sequence', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->numberingSequences();

    $dto = new GetCurrentNumberingSequenceRequestDto('INV-2025');

    $mockData = [
        'name' => 'INV-2025',
        'format' => 'INV-{number}',
        'number' => 1,
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->getCurrent($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('can update current numbering sequence', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->numberingSequences();

    $dto = new UpdateCurrentNumberingSequenceRequestDto('INV-2025', [
        'name' => 'INV-2025',
        'format' => 'INV-{number}',
        'number' => 10,
    ]);

    $mockData = [
        'name' => 'INV-2025',
        'format' => 'INV-{number}',
        'number' => 10,
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->updateCurrent($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});
