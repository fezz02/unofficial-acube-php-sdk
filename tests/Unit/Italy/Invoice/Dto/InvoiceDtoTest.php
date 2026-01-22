<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Concerns\InvoiceMarking;
use Fezz\Acube\Sdk\Italy\Invoice\Dto\InvoiceDto;

test('can create invoice dto with InvoiceMarking instance', function (): void {
    $data = [
        'uuid' => 'invoice-uuid-123',
        'marking' => InvoiceMarking::SENT,
        'notice' => null,
    ];

    $dto = InvoiceDto::from($data);

    expect($dto)
        ->toBeInstanceOf(InvoiceDto::class)
        ->and($dto->uuid)->toBe('invoice-uuid-123')
        ->and($dto->marking)->toBe(InvoiceMarking::SENT);
});
