<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Concerns\InvoiceMarking;

test('invoice marking enum has correct values', function (): void {
    expect(InvoiceMarking::SIGNED->value)->toBe('signed')
        ->and(InvoiceMarking::WAITING->value)->toBe('waiting')
        ->and(InvoiceMarking::QUARANTENA->value)->toBe('quarantena')
        ->and(InvoiceMarking::SENT->value)->toBe('sent')
        ->and(InvoiceMarking::INVOICE_ERROR->value)->toBe('invoice-error')
        ->and(InvoiceMarking::RECEIVED->value)->toBe('received')
        ->and(InvoiceMarking::DELIVERED->value)->toBe('delivered')
        ->and(InvoiceMarking::DELIVERED_PA->value)->toBe('delivered-pa')
        ->and(InvoiceMarking::NOT_DELIVERED->value)->toBe('not-delivered')
        ->and(InvoiceMarking::ACCEPTED_PA->value)->toBe('accepted-pa')
        ->and(InvoiceMarking::REJECTED_PA->value)->toBe('rejected-pa')
        ->and(InvoiceMarking::DEADLINE_TERMS->value)->toBe('deadline-terms')
        ->and(InvoiceMarking::NOTIFICATION_ERROR->value)->toBe('notification-error')
        ->and(InvoiceMarking::REJECTED->value)->toBe('rejected');
});

test('label returns correct labels for all invoice markings', function (): void {
    expect(InvoiceMarking::SIGNED->label())->toBe('Firmata')
        ->and(InvoiceMarking::WAITING->label())->toBe('In attesa')
        ->and(InvoiceMarking::QUARANTENA->label())->toBe('Quarantena')
        ->and(InvoiceMarking::SENT->label())->toBe('Inviata')
        ->and(InvoiceMarking::INVOICE_ERROR->label())->toBe('Errore fattura')
        ->and(InvoiceMarking::RECEIVED->label())->toBe('Ricevuta')
        ->and(InvoiceMarking::DELIVERED->label())->toBe('Consegnata')
        ->and(InvoiceMarking::DELIVERED_PA->label())->toBe('Consegnata PA')
        ->and(InvoiceMarking::NOT_DELIVERED->label())->toBe('Non consegnata')
        ->and(InvoiceMarking::ACCEPTED_PA->label())->toBe('Accettata PA')
        ->and(InvoiceMarking::REJECTED_PA->label())->toBe('Rifiutata PA')
        ->and(InvoiceMarking::REJECTED->label())->toBe('Rifiutata')
        ->and(InvoiceMarking::DEADLINE_TERMS->label())->toBe('Decorrenza termini')
        ->and(InvoiceMarking::NOTIFICATION_ERROR->label())->toBe('Errore notifica');
});
