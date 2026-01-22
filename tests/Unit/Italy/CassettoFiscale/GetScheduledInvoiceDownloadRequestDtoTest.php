<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\CassettoFiscale\Dto\GetScheduledInvoiceDownloadRequestDto;

test('get scheduled invoice download request dto can be created', function (): void {
    $dto = new GetScheduledInvoiceDownloadRequestDto(
        fiscal_id: 'IT12345678901'
    );

    expect($dto)
        ->toBeInstanceOf(GetScheduledInvoiceDownloadRequestDto::class)
        ->and($dto->fiscal_id)->toBe('IT12345678901');
});

test('get scheduled invoice download request dto can be created from array', function (): void {
    $dto = GetScheduledInvoiceDownloadRequestDto::from([
        'fiscal_id' => 'IT98765432101',
    ]);

    expect($dto)
        ->toBeInstanceOf(GetScheduledInvoiceDownloadRequestDto::class)
        ->and($dto->fiscal_id)->toBe('IT98765432101');
});
