<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Concerns\NotificationType;

test('notification type enum has correct values', function (): void {
    expect(NotificationType::NOTIFICA_SCARTO->value)->toBe('NS')
        ->and(NotificationType::FILE_METADATI->value)->toBe('MT')
        ->and(NotificationType::RICEVUTA_CONSEGNA->value)->toBe('RC')
        ->and(NotificationType::MANCATA_CONSEGNA->value)->toBe('MC')
        ->and(NotificationType::ESITO_COMMITTENTE->value)->toBe('EC')
        ->and(NotificationType::SCARTO_ESITO_COMMITTENTE->value)->toBe('SE')
        ->and(NotificationType::NOTIFICA_ESITO->value)->toBe('NE')
        ->and(NotificationType::DECORRENZA_TERMINI->value)->toBe('DT')
        ->and(NotificationType::ATTESTAZIONE_TRASMISSIONE->value)->toBe('AT');
});

test('label returns correct labels for all notification types', function (): void {
    expect(NotificationType::NOTIFICA_SCARTO->label())->toBe('Notifica di scarto')
        ->and(NotificationType::FILE_METADATI->label())->toBe('File metadati')
        ->and(NotificationType::RICEVUTA_CONSEGNA->label())->toBe('Ricevuta consegna')
        ->and(NotificationType::MANCATA_CONSEGNA->label())->toBe('Mancata consegna')
        ->and(NotificationType::ESITO_COMMITTENTE->label())->toBe('Esito committente')
        ->and(NotificationType::SCARTO_ESITO_COMMITTENTE->label())->toBe('Scarto esito committente')
        ->and(NotificationType::NOTIFICA_ESITO->label())->toBe('Notifica esito')
        ->and(NotificationType::DECORRENZA_TERMINI->label())->toBe('Decorrenza termini')
        ->and(NotificationType::ATTESTAZIONE_TRASMISSIONE->label())->toBe('Attestazione trasmissione con impossibilità di recapito');
});
