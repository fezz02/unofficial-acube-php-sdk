<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Concerns\InvoiceExtractJobStatus;
use Fezz\Acube\Sdk\Italy\InvoiceExtract\Dto\InvoiceExtractJobDto;

test('can create invoice extract job dto with string job_status', function (): void {
    $data = [
        'uuid' => 'job-uuid-123',
        'acquisition_date' => '2024-01-01T00:00:00Z',
        'filename' => 'invoice.pdf',
        'job_status' => 'success', // String, should parse to enum (line 46)
    ];

    $dto = InvoiceExtractJobDto::from($data);

    expect($dto)
        ->toBeInstanceOf(InvoiceExtractJobDto::class)
        ->and($dto->uuid)->toBe('job-uuid-123')
        ->and($dto->job_status)->toBe(InvoiceExtractJobStatus::SUCCESS);
});

test('can create invoice extract job dto with non-string job_status', function (): void {
    $data = [
        'uuid' => 'job-uuid-123',
        'acquisition_date' => '2024-01-01T00:00:00Z',
        'filename' => 'invoice.pdf',
        'job_status' => 123, // Not a string, should default to WAITING (line 47)
    ];

    $dto = InvoiceExtractJobDto::from($data);

    expect($dto)
        ->toBeInstanceOf(InvoiceExtractJobDto::class)
        ->and($dto->uuid)->toBe('job-uuid-123')
        ->and($dto->job_status)->toBe(InvoiceExtractJobStatus::WAITING);
});

test('can create invoice extract job dto with missing job_status', function (): void {
    $data = [
        'uuid' => 'job-uuid-123',
        'acquisition_date' => '2024-01-01T00:00:00Z',
        'filename' => 'invoice.pdf',
        // job_status is missing, should default to WAITING (line 46)
    ];

    $dto = InvoiceExtractJobDto::from($data);

    expect($dto)
        ->toBeInstanceOf(InvoiceExtractJobDto::class)
        ->and($dto->uuid)->toBe('job-uuid-123')
        ->and($dto->job_status)->toBe(InvoiceExtractJobStatus::WAITING);
});
