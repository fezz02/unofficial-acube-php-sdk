<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Concerns\NotificationType;
use Fezz\Acube\Sdk\Italy\Webhooks\CustomerNotification\CustomerNotificationWebhookDto;

test('can create customer notification webhook data from array with full payload', function (): void {
    $data = [
        'notification' => [
            'uuid' => 'af3dec38-51f8-48db-b6fe-b576fe72aec7',
            'invoice_uuid' => '019b31fe-138b-7091-bc14-902396600000',
            'created_at' => '2025-12-18T15:06:02+00:00',
            'type' => 'NS',
            'file_name' => '20251218_150602_818401_97c5f74bdceb9948664b25835d64e7c0.xml',
            'message' => [
                'identificativo_sdi' => '111',
                'nome_file' => 'IT01234567890_11111.xml.p7m',
                'data_ora_ricezione' => '2013-06-06T12:00:00+00:00',
                'riferimento_archivio' => [
                    'identificativo_sdi' => '100',
                    'nome_file' => 'IT01234567890_11111.zip',
                ],
                'lista_errori' => [
                    'Errore' => [
                        'Codice' => '00100',
                        'Descrizione' => 'Certificato di firma scaduto',
                    ],
                ],
                'message_id' => '123456',
                'note' => 'Note',
            ],
            'downloaded' => false,
        ],
    ];

    $dto = CustomerNotificationWebhookDto::from($data);

    expect($dto)
        ->toBeInstanceOf(CustomerNotificationWebhookDto::class)
        ->and($dto->notification)->toBeInstanceOf(Fezz\Acube\Sdk\Italy\Webhooks\CustomerNotification\Notification\CustomerNotificationDto::class)
        ->and($dto->notification->uuid)->toBe('af3dec38-51f8-48db-b6fe-b576fe72aec7')
        ->and($dto->notification->invoice_uuid)->toBe('019b31fe-138b-7091-bc14-902396600000')
        ->and($dto->notification->created_at)->toBe('2025-12-18T15:06:02+00:00')
        ->and($dto->notification->type)->toBe(NotificationType::NOTIFICA_SCARTO)
        ->and($dto->notification->file_name)->toBe('20251218_150602_818401_97c5f74bdceb9948664b25835d64e7c0.xml')
        ->and($dto->notification->downloaded)->toBeFalse()
        ->and($dto->notification->message)->toBeInstanceOf(Fezz\Acube\Sdk\Italy\Webhooks\CustomerNotification\Notification\CustomerNotificationMessageDto::class)
        ->and($dto->notification->message->identificativo_sdi)->toBe('111')
        ->and($dto->notification->message->nome_file)->toBe('IT01234567890_11111.xml.p7m')
        ->and($dto->notification->message->data_ora_ricezione)->toBe('2013-06-06T12:00:00+00:00')
        ->and($dto->notification->message->message_id)->toBe('123456')
        ->and($dto->notification->message->note)->toBe('Note')
        ->and($dto->notification->message->riferimento_archivio)->toBeInstanceOf(Fezz\Acube\Sdk\Italy\Webhooks\CustomerNotification\Notification\ArchiveReferenceDto::class)
        ->and($dto->notification->message->riferimento_archivio->identificativo_sdi)->toBe('100')
        ->and($dto->notification->message->riferimento_archivio->nome_file)->toBe('IT01234567890_11111.zip')
        ->and($dto->notification->message->lista_errori)->toHaveCount(1)
        ->and($dto->notification->message->lista_errori[0])->toBeInstanceOf(Fezz\Acube\Sdk\Italy\Webhooks\CustomerNotification\Notification\ErrorDto::class)
        ->and($dto->notification->message->lista_errori[0]->codice)->toBe('00100')
        ->and($dto->notification->message->lista_errori[0]->descrizione)->toBe('Certificato di firma scaduto');
});

test('can create customer notification webhook data with invoice', function (): void {
    $data = [
        'notification' => [
            'uuid' => 'notification-uuid-123',
            'invoice_uuid' => 'invoice-uuid-456',
            'created_at' => '2024-01-01T00:00:00Z',
            'type' => 'RC',
            'file_name' => 'test.xml',
            'message' => [
                'identificativo_sdi' => '111',
                'nome_file' => 'test.xml.p7m',
                'data_ora_ricezione' => '2024-01-01T00:00:00Z',
            ],
            'downloaded' => true,
        ],
        'invoice' => [
            'uuid' => 'invoice-uuid-456',
            'marking' => 'sent',
            'notice' => null,
            'additional_fields' => [],
            'fattura_elettronica_header' => [],
            'fattura_elettronica_body' => [],
        ],
    ];

    $dto = CustomerNotificationWebhookDto::from($data);

    expect($dto)
        ->toBeInstanceOf(CustomerNotificationWebhookDto::class)
        ->and($dto->invoice)->toBeInstanceOf(Fezz\Acube\Sdk\Italy\Webhooks\CustomerNotification\Notification\InvoiceDto::class);
});

test('can create customer notification webhook data without invoice', function (): void {
    $data = [
        'notification' => [
            'uuid' => 'notification-uuid-123',
            'invoice_uuid' => 'invoice-uuid-456',
            'created_at' => '2024-01-01T00:00:00Z',
            'type' => 'NS',
            'file_name' => 'test.xml',
            'message' => [
                'identificativo_sdi' => '111',
                'nome_file' => 'test.xml.p7m',
                'data_ora_ricezione' => '2024-01-01T00:00:00Z',
            ],
            'downloaded' => false,
        ],
    ];

    $dto = CustomerNotificationWebhookDto::from($data);

    expect($dto)
        ->toBeInstanceOf(CustomerNotificationWebhookDto::class)
        ->and($dto->invoice)->toBeNull();
});

test('can create customer notification webhook data with multiple errors', function (): void {
    $data = [
        'notification' => [
            'uuid' => 'notification-uuid-123',
            'invoice_uuid' => 'invoice-uuid-456',
            'created_at' => '2024-01-01T00:00:00Z',
            'type' => 'NS',
            'file_name' => 'test.xml',
            'message' => [
                'identificativo_sdi' => '111',
                'nome_file' => 'test.xml.p7m',
                'data_ora_ricezione' => '2024-01-01T00:00:00Z',
                'lista_errori' => [
                    'Errore' => [
                        [
                            'Codice' => '00100',
                            'Descrizione' => 'Error 1',
                        ],
                        [
                            'Codice' => '00101',
                            'Descrizione' => 'Error 2',
                        ],
                    ],
                ],
            ],
            'downloaded' => false,
        ],
    ];

    $dto = CustomerNotificationWebhookDto::from($data);

    expect($dto->notification->message->lista_errori)
        ->toHaveCount(2)
        ->and($dto->notification->message->lista_errori[0]->codice)->toBe('00100')
        ->and($dto->notification->message->lista_errori[0]->descrizione)->toBe('Error 1')
        ->and($dto->notification->message->lista_errori[1]->codice)->toBe('00101')
        ->and($dto->notification->message->lista_errori[1]->descrizione)->toBe('Error 2');
});

test('can create customer notification webhook data with list errors containing non-array items', function (): void {
    // Test when Errore is a list but contains non-array items (tests line 61 condition)
    $data = [
        'notification' => [
            'uuid' => 'notification-uuid-mixed-errors',
            'invoice_uuid' => 'invoice-uuid-456',
            'created_at' => '2024-01-01T00:00:00Z',
            'type' => 'NS',
            'file_name' => 'test.xml',
            'message' => [
                'identificativo_sdi' => '111',
                'nome_file' => 'test.xml.p7m',
                'data_ora_ricezione' => '2024-01-01T00:00:00Z',
                'lista_errori' => [
                    'Errore' => [
                        [
                            'Codice' => '00100',
                            'Descrizione' => 'Error 1',
                        ],
                        'not-an-array', // Non-array item in the list - tests line 61
                        [
                            'Codice' => '00101',
                            'Descrizione' => 'Error 2',
                        ],
                    ],
                ],
            ],
            'downloaded' => false,
        ],
    ];

    $dto = CustomerNotificationWebhookDto::from($data);

    expect($dto->notification->message->lista_errori)
        ->toHaveCount(2) // Only the array items should be processed
        ->and($dto->notification->message->lista_errori[0]->codice)->toBe('00100')
        ->and($dto->notification->message->lista_errori[1]->codice)->toBe('00101');
});

test('can create customer notification webhook data without optional fields', function (): void {
    $data = [
        'notification' => [
            'uuid' => 'notification-uuid-123',
            'invoice_uuid' => 'invoice-uuid-456',
            'created_at' => '2024-01-01T00:00:00Z',
            'type' => 'NS',
            'file_name' => null,
            'message' => [
                'identificativo_sdi' => '111',
                'nome_file' => 'test.xml.p7m',
                'data_ora_ricezione' => '2024-01-01T00:00:00Z',
            ],
            'downloaded' => false,
        ],
    ];

    $dto = CustomerNotificationWebhookDto::from($data);

    expect($dto)
        ->toBeInstanceOf(CustomerNotificationWebhookDto::class)
        ->and($dto->notification->file_name)->toBeNull()
        ->and($dto->notification->message->riferimento_archivio)->toBeNull()
        ->and($dto->notification->message->lista_errori)->toBeEmpty()
        ->and($dto->notification->message->message_id)->toBeNull()
        ->and($dto->notification->message->note)->toBeNull();
});

test('can create customer notification webhook data with non-array message', function (): void {
    // Test CustomerNotificationDto when message is not an array (tests line 52)
    $data = [
        'notification' => [
            'uuid' => 'notification-uuid-non-array-message',
            'invoice_uuid' => 'invoice-uuid-456',
            'created_at' => '2024-01-01T00:00:00Z',
            'type' => 'NS',
            'file_name' => 'test.xml',
            'message' => 'not-an-array', // Not an array - tests line 52 in CustomerNotificationDto
            'downloaded' => false,
        ],
    ];

    $dto = CustomerNotificationWebhookDto::from($data);

    expect($dto)
        ->toBeInstanceOf(CustomerNotificationWebhookDto::class)
        ->and($dto->notification->message->identificativo_sdi)->toBe('')
        ->and($dto->notification->message->nome_file)->toBe('')
        ->and($dto->notification->message->data_ora_ricezione)->toBe('');
});

test('can create customer notification webhook data with invalid type value', function (): void {
    // Test CustomerNotificationDto when type is not a string or int (tests line 49)
    $data = [
        'notification' => [
            'uuid' => 'notification-uuid-invalid-type',
            'invoice_uuid' => 'invoice-uuid-456',
            'created_at' => '2024-01-01T00:00:00Z',
            'type' => [], // Not a string or int - tests line 49 fallback
            'file_name' => 'test.xml',
            'message' => [
                'identificativo_sdi' => '111',
                'nome_file' => 'test.xml.p7m',
                'data_ora_ricezione' => '2024-01-01T00:00:00Z',
            ],
            'downloaded' => false,
        ],
    ];

    $dto = CustomerNotificationWebhookDto::from($data);

    expect($dto)
        ->toBeInstanceOf(CustomerNotificationWebhookDto::class)
        ->and($dto->notification->type)->toBe(NotificationType::NOTIFICA_SCARTO);
});

test('can create customer notification webhook data with invalid type string that throws ValueError', function (): void {
    // Test CustomerNotificationDto when type is a string but invalid enum value (tests catch block lines 51-52)
    $data = [
        'notification' => [
            'uuid' => 'notification-uuid-invalid-type-string',
            'invoice_uuid' => 'invoice-uuid-456',
            'created_at' => '2024-01-01T00:00:00Z',
            'type' => 'INVALID_TYPE', // Valid string but invalid enum value - triggers ValueError catch
            'file_name' => 'test.xml',
            'message' => [
                'identificativo_sdi' => '111',
                'nome_file' => 'test.xml.p7m',
                'data_ora_ricezione' => '2024-01-01T00:00:00Z',
            ],
            'downloaded' => false,
        ],
    ];

    $dto = CustomerNotificationWebhookDto::from($data);

    expect($dto)
        ->toBeInstanceOf(CustomerNotificationWebhookDto::class)
        ->and($dto->notification->type)->toBe(NotificationType::NOTIFICA_SCARTO);
});

test('can create customer notification webhook data with empty lista_errori', function (): void {
    // Test CustomerNotificationMessageDto when lista_errori is empty or doesn't have 'Errore' key
    $data = [
        'notification' => [
            'uuid' => 'notification-uuid-empty-errors',
            'invoice_uuid' => 'invoice-uuid-456',
            'created_at' => '2024-01-01T00:00:00Z',
            'type' => 'NS',
            'file_name' => 'test.xml',
            'message' => [
                'identificativo_sdi' => '111',
                'nome_file' => 'test.xml.p7m',
                'data_ora_ricezione' => '2024-01-01T00:00:00Z',
                'lista_errori' => [], // Empty array - tests line 52 condition
            ],
            'downloaded' => false,
        ],
    ];

    $dto = CustomerNotificationWebhookDto::from($data);

    expect($dto)
        ->toBeInstanceOf(CustomerNotificationWebhookDto::class)
        ->and($dto->notification->message->lista_errori)->toBeEmpty();
});

test('can create customer notification webhook data with lista_errori missing Errore key', function (): void {
    // Test CustomerNotificationMessageDto when lista_errori exists but doesn't have 'Errore' key
    $data = [
        'notification' => [
            'uuid' => 'notification-uuid-no-errore',
            'invoice_uuid' => 'invoice-uuid-456',
            'created_at' => '2024-01-01T00:00:00Z',
            'type' => 'NS',
            'file_name' => 'test.xml',
            'message' => [
                'identificativo_sdi' => '111',
                'nome_file' => 'test.xml.p7m',
                'data_ora_ricezione' => '2024-01-01T00:00:00Z',
                'lista_errori' => [
                    'other_key' => 'value', // Has lista_errori but no 'Errore' key - tests line 52 condition
                ],
            ],
            'downloaded' => false,
        ],
    ];

    $dto = CustomerNotificationWebhookDto::from($data);

    expect($dto)
        ->toBeInstanceOf(CustomerNotificationWebhookDto::class)
        ->and($dto->notification->message->lista_errori)->toBeEmpty();
});

test('can create customer notification webhook data with Errore as non-array', function (): void {
    // Test CustomerNotificationMessageDto when Errore exists but is not an array
    // This tests the case where $errore is not an array (neither branch in lines 58-68 executes)
    $data = [
        'notification' => [
            'uuid' => 'notification-uuid-non-array-errore',
            'invoice_uuid' => 'invoice-uuid-456',
            'created_at' => '2024-01-01T00:00:00Z',
            'type' => 'NS',
            'file_name' => 'test.xml',
            'message' => [
                'identificativo_sdi' => '111',
                'nome_file' => 'test.xml.p7m',
                'data_ora_ricezione' => '2024-01-01T00:00:00Z',
                'lista_errori' => [
                    'Errore' => 'not-an-array', // Errore is not an array - tests line 52 and branches
                ],
            ],
            'downloaded' => false,
        ],
    ];

    $dto = CustomerNotificationWebhookDto::from($data);

    expect($dto)
        ->toBeInstanceOf(CustomerNotificationWebhookDto::class)
        ->and($dto->notification->message->lista_errori)->toBeEmpty();
});

test('can create customer notification webhook data with non-array notification', function (): void {
    // Test CustomerNotificationWebhookDto when notification is not an array (tests line 48)
    $data = [
        'notification' => 'not-an-array', // Not an array - tests line 48
    ];

    $dto = CustomerNotificationWebhookDto::from($data);

    expect($dto)
        ->toBeInstanceOf(CustomerNotificationWebhookDto::class)
        ->and($dto->notification->uuid)->toBe('')
        ->and($dto->notification->invoice_uuid)->toBe('')
        ->and($dto->notification->created_at)->toBe('');
});
