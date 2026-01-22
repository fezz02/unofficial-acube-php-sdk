<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Webhooks\CustomerNotification\Notification;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object representing an error (Errore) in a notification message.
 *
 * This DTO represents a single error from the lista_errori, containing the error code
 * and description.
 */
final readonly class ErrorDto extends Dto
{
    /**
     * Create a new error DTO.
     *
     * @param  string  $codice  The error code
     * @param  string  $descrizione  The error description
     */
    public function __construct(
        public string $codice,
        public string $descrizione,
    ) {}

    /**
     * Create an error DTO from an array.
     *
     * Handles both 'Codice'/'Descrizione' and 'codice'/'descrizione' key formats.
     *
     * @param  array<string, mixed>  $data  The error data
     */
    public static function from(array $data): static
    {
        $codice = $data['Codice'] ?? $data['codice'] ?? '';
        $descrizione = $data['Descrizione'] ?? $data['descrizione'] ?? '';

        return new self(
            codice: is_string($codice) ? $codice : '',
            descrizione: is_string($descrizione) ? $descrizione : '',
        );
    }
}
