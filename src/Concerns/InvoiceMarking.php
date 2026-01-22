<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Concerns;

use Fezz\Acube\Sdk\Contracts\Labellable;

/**
 * Enumeration of invoice marking (status) values.
 *
 * Invoice marking represents the current status of an invoice in the SDI
 * (Sistema di Interscambio) workflow. The marking changes as the invoice
 * progresses through various stages from creation to final delivery.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
enum InvoiceMarking: string implements Labellable
{
    case SIGNED = 'signed';
    case WAITING = 'waiting';
    case QUARANTENA = 'quarantena';
    case SENT = 'sent';
    case INVOICE_ERROR = 'invoice-error';
    case RECEIVED = 'received';
    case DELIVERED = 'delivered';
    case DELIVERED_PA = 'delivered-pa';
    case NOT_DELIVERED = 'not-delivered';
    case ACCEPTED_PA = 'accepted-pa';
    case REJECTED_PA = 'rejected-pa';
    case DEADLINE_TERMS = 'deadline-terms';
    case NOTIFICATION_ERROR = 'notification-error';
    case REJECTED = 'rejected';

    /**
     * Get the label for this invoice marking.
     */
    public function label(): string
    {
        return match ($this) {
            self::SIGNED => 'Firmata',
            self::WAITING => 'In attesa',
            self::QUARANTENA => 'Quarantena',
            self::SENT => 'Inviata',
            self::INVOICE_ERROR => 'Errore fattura',
            self::RECEIVED => 'Ricevuta',
            self::DELIVERED => 'Consegnata',
            self::DELIVERED_PA => 'Consegnata PA',
            self::NOT_DELIVERED => 'Non consegnata',
            self::ACCEPTED_PA => 'Accettata PA',
            self::REJECTED_PA => 'Rifiutata PA',
            self::REJECTED => 'Rifiutata',
            self::DEADLINE_TERMS => 'Decorrenza termini',
            self::NOTIFICATION_ERROR => 'Errore notifica',
        };
    }
}
