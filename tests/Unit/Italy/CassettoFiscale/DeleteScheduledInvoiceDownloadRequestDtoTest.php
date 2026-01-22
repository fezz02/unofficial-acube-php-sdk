<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\CassettoFiscale\Dto\DeleteScheduledInvoiceDownloadRequestDto;

test('delete scheduled invoice download request dto can be created', function (): void {
    $dto = new DeleteScheduledInvoiceDownloadRequestDto(
        fiscal_id: 'IT12345678901'
    );

    expect($dto)
        ->toBeInstanceOf(DeleteScheduledInvoiceDownloadRequestDto::class)
        ->and($dto->fiscal_id)->toBe('IT12345678901');
});

test('delete scheduled invoice download request dto can be created from array', function (): void {
    $dto = DeleteScheduledInvoiceDownloadRequestDto::from([
        'fiscal_id' => 'IT98765432101',
    ]);

    expect($dto)
        ->toBeInstanceOf(DeleteScheduledInvoiceDownloadRequestDto::class)
        ->and($dto->fiscal_id)->toBe('IT98765432101');
});
