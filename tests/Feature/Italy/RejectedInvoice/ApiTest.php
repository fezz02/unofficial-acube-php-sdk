<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\AcubeApi;
use Fezz\Acube\Sdk\Italy\RejectedInvoice\Dto\GetRejectedInvoicesCountRequestDto;
use Fezz\Acube\Sdk\Italy\RejectedInvoice\Dto\RecoverRejectedInvoicesRequestDto;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('can get rejected invoices count', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->rejectedInvoices();

    $dto = new GetRejectedInvoicesCountRequestDto(
        fiscal_id: 'IT12345678901',
        from_date: '2024-01-01',
        to_date: '2024-01-31'
    );

    $mockData = [
        'count' => 5,
        'pending' => 0,
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->count($dto);
    $responseDto = $response->dto();

    expect($responseDto)
        ->toBeInstanceOf(Fezz\Acube\Sdk\Italy\RejectedInvoice\Dto\RejectedInvoicesCountDto::class)
        ->and($responseDto->count)->toBe(5);
});

test('can recover rejected invoices', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->rejectedInvoices();

    $dto = new RecoverRejectedInvoicesRequestDto(
        from_date: '2024-01-01',
        to_date: '2024-01-31'
    );

    $mockData = [
        'uuid' => 'recovery-job-uuid-123',
        'count' => 5,
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->recover('IT12345678901', $dto);
    $responseDto = $response->dto();

    expect($responseDto)
        ->toBeInstanceOf(Fezz\Acube\Sdk\Italy\RejectedInvoice\Dto\RecoverRejectedInvoicesResponseDto::class)
        ->and($responseDto->uuid)->toBe('recovery-job-uuid-123')
        ->and($responseDto->count)->toBe(5);
});
