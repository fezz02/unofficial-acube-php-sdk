<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\InvoiceTransfer\Dto\InvoiceTransferDto;

test('invoice transfer dto can be created from array', function (): void {
    $data = [
        'uuid' => 'transfer-123',
        'supplier_fiscal_id' => 'FISCAL123',
        'created_at' => '2024-01-01T00:00:00Z',
    ];

    $dto = InvoiceTransferDto::from($data);

    expect($dto)
        ->toBeInstanceOf(InvoiceTransferDto::class)
        ->and($dto->uuid)->toBe('transfer-123')
        ->and($dto->supplier_fiscal_id)->toBe('FISCAL123')
        ->and($dto->created_at)->toBe('2024-01-01T00:00:00Z');
});
