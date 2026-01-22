<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Concerns\InvoiceExtractJobStatus;

test('invoice extract job status enum has correct values', function (): void {
    expect(InvoiceExtractJobStatus::WAITING->value)->toBe('waiting')
        ->and(InvoiceExtractJobStatus::SUCCESS->value)->toBe('success')
        ->and(InvoiceExtractJobStatus::ERROR->value)->toBe('error');
});

test('label returns correct labels for all job statuses', function (): void {
    expect(InvoiceExtractJobStatus::WAITING->label())->toBe('In attesa')
        ->and(InvoiceExtractJobStatus::SUCCESS->label())->toBe('Completato con successo')
        ->and(InvoiceExtractJobStatus::ERROR->label())->toBe('Errore');
});
