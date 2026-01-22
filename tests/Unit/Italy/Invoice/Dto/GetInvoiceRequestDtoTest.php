<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\Invoice\Dto\GetInvoiceRequestDto;

test('get invoice request dto can be created with uuid', function (): void {
    $dto = new GetInvoiceRequestDto('invoice-uuid-123');

    expect($dto)
        ->toBeInstanceOf(GetInvoiceRequestDto::class)
        ->and($dto->uuid)->toBe('invoice-uuid-123');
});

test('get invoice request dto can be created from array', function (): void {
    $dto = GetInvoiceRequestDto::from(['uuid' => 'invoice-uuid-456']);

    expect($dto)
        ->toBeInstanceOf(GetInvoiceRequestDto::class)
        ->and($dto->uuid)->toBe('invoice-uuid-456');
});
