<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Webhooks\CustomerNotification\Notification;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object representing the message content within a customer notification.
 *
 * This DTO represents the message object within a notification, containing SDI information,
 * file details, archive references, error lists, and other message metadata.
 *
 * Note: lista_errori['Errore'] can be either a single error object or an array of error objects.
 * This DTO normalizes it to always be an array of ErrorDto.
 */
final readonly class CustomerNotificationMessageDto extends Dto
{
    /**
     * Create a new customer notification message DTO.
     *
     * @param  string  $identificativo_sdi  The SDI identifier
     * @param  string  $nome_file  The file name
     * @param  string  $data_ora_ricezione  ISO 8601 timestamp when the file was received
     * @param  ArchiveReferenceDto|null  $riferimento_archivio  Optional archive reference
     * @param  array<int, ErrorDto>  $lista_errori  List of errors
     * @param  string|null  $message_id  Optional message ID
     * @param  string|null  $note  Optional notes
     */
    public function __construct(
        public string $identificativo_sdi,
        public string $nome_file,
        public string $data_ora_ricezione,
        public ?ArchiveReferenceDto $riferimento_archivio = null,
        public array $lista_errori = [],
        public ?string $message_id = null,
        public ?string $note = null,
    ) {}

    /**
     * Create a customer notification message DTO from an array.
     *
     * @param  array<string, mixed>  $data  The message data
     */
    public static function from(array $data): static
    {
        $riferimento_archivio = isset($data['riferimento_archivio']) && is_array($data['riferimento_archivio'])
            ? ArchiveReferenceDto::from($data['riferimento_archivio'])
            : null;

        $lista_errori = [];
        // Normalize lista_errori: Errore can be single object or array of objects
        $listaErroriData = $data['lista_errori'] ?? [];
        if (is_array($listaErroriData) && $listaErroriData !== [] && isset($listaErroriData['Errore'])) {
            $errore = $listaErroriData['Errore'];

            // Check if it's an array of errors (has numeric keys) or a single error object
            if (is_array($errore) && array_is_list($errore)) {
                // Array of error objects (sequential numeric keys)
                foreach ($errore as $errorData) {
                    if (is_array($errorData)) {
                        /** @var array<string, mixed> $errorData */
                        $lista_errori[] = ErrorDto::from($errorData);
                    }
                }
            } elseif (is_array($errore)) {
                // Single error object (associative array)
                /** @var array<string, mixed> $errore */
                $lista_errori[] = ErrorDto::from($errore);
            }
        }

        return new self(
            identificativo_sdi: is_string($data['identificativo_sdi'] ?? null) ? $data['identificativo_sdi'] : '',
            nome_file: is_string($data['nome_file'] ?? null) ? $data['nome_file'] : '',
            data_ora_ricezione: is_string($data['data_ora_ricezione'] ?? null) ? $data['data_ora_ricezione'] : '',
            riferimento_archivio: $riferimento_archivio,
            lista_errori: $lista_errori,
            message_id: isset($data['message_id']) && is_string($data['message_id']) ? $data['message_id'] : null,
            note: isset($data['note']) && is_string($data['note']) ? $data['note'] : null,
        );
    }
}
