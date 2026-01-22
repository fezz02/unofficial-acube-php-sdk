<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Concerns;

use Fezz\Acube\Sdk\Contracts\Labellable;

/**
 * Enumeration of notification type codes.
 *
 * Notification types represent different events in the SDI (Sistema di Interscambio)
 * workflow, such as delivery receipts, acceptance/rejection notifications, etc.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/notifications/
 */
enum NotificationType: string implements Labellable
{
    case NOTIFICA_SCARTO = 'NS'; // Notifica di scarto → invoice marking becomes rejected
    case FILE_METADATI = 'MT'; // File metadati
    case RICEVUTA_CONSEGNA = 'RC'; // Ricevuta consegna → invoice marking delivered (B2B) / delivered-pa (B2G)
    case MANCATA_CONSEGNA = 'MC'; // Mancata consegna → not-delivered
    case ESITO_COMMITTENTE = 'EC'; // Esito committente (only PA users)
    case SCARTO_ESITO_COMMITTENTE = 'SE'; // Scarto esito committente (PA)
    case NOTIFICA_ESITO = 'NE'; // Notifica esito (PA decision): accepted-pa for EC01, rejected-pa for EC02
    case DECORRENZA_TERMINI = 'DT'; // Decorrenza termini → deadline-terms
    case ATTESTAZIONE_TRASMISSIONE = 'AT'; // Attestazione trasmissione con impossibilità di recapito → not-delivered

    /**
     * Get the label for this notification type.
     */
    public function label(): string
    {
        return match ($this) {
            self::NOTIFICA_SCARTO => 'Notifica di scarto',
            self::FILE_METADATI => 'File metadati',
            self::RICEVUTA_CONSEGNA => 'Ricevuta consegna',
            self::MANCATA_CONSEGNA => 'Mancata consegna',
            self::ESITO_COMMITTENTE => 'Esito committente',
            self::SCARTO_ESITO_COMMITTENTE => 'Scarto esito committente',
            self::NOTIFICA_ESITO => 'Notifica esito',
            self::DECORRENZA_TERMINI => 'Decorrenza termini',
            self::ATTESTAZIONE_TRASMISSIONE => 'Attestazione trasmissione con impossibilità di recapito',
        };
    }
}
