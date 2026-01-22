<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\Receipt\Dto\ReceiptDto;

test('receipt dto can be created from array', function (): void {
    $data = [
        'id' => 'receipt-123',
        'number' => 'REC-001',
        'date' => '2024-01-01',
    ];

    $dto = ReceiptDto::from($data);

    expect($dto)
        ->toBeInstanceOf(ReceiptDto::class)
        ->and($dto->data)->toBe($data);
});
