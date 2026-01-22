<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\Invoice\Dto\GetInvoicesResponseDto;

test('can create from empty array', function (): void {
    $dto = GetInvoicesResponseDto::from([]);

    expect($dto)
        ->toBeInstanceOf(GetInvoicesResponseDto::class)
        ->and($dto->invoices)->toBe([]);
});
