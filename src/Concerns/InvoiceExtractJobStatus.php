<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Concerns;

use Fezz\Acube\Sdk\Contracts\Labellable;

/**
 * Enumeration of invoice extract job status values.
 *
 * Job status represents the current state of an invoice extraction job
 * that converts PDF invoices to FatturaPA XML/JSON format.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoice-extract/
 */
enum InvoiceExtractJobStatus: string implements Labellable
{
    case WAITING = 'waiting';
    case SUCCESS = 'success';
    case ERROR = 'error';

    /**
     * Get the label for this job status.
     */
    public function label(): string
    {
        return match ($this) {
            self::WAITING => 'In attesa',
            self::SUCCESS => 'Completato con successo',
            self::ERROR => 'Errore',
        };
    }
}
