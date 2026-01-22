<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\Webhooks\SupplierInvoice\SupplierInvoiceWebhookDto;

test('can create supplier invoice webhook dto using constructor with array', function (): void {
    $data = [
        'invoice' => [
            'uuid' => '019b47b3-155c-7d1b-93ca-56b63d5090c0',
            'created_at' => '2025-12-22T20:14:37+00:00',
            'filename' => 'prova.xml',
            'file_id' => '0',
            'payload' => [
                'fattura_elettronica_header' => [
                    'dati_trasmissione' => [
                        'id_trasmittente' => [
                            'id_paese' => 'IT',
                            'id_codice' => '04155930920',
                        ],
                        'progressivo_invio' => '10TER',
                        'formato_trasmissione' => 'FPR12',
                        'codice_destinatario' => '3C984HL',
                    ],
                    'cedente_prestatore' => [
                        'dati_anagrafici' => [
                            'id_fiscale_iva' => [
                                'id_paese' => 'IT',
                                'id_codice' => '04155930920',
                            ],
                            'codice_fiscale' => '04155930920',
                            'anagrafica' => [
                                'denominazione' => 'FEZZ SRL',
                            ],
                            'regime_fiscale' => 'RF11',
                        ],
                        'sede' => [
                            'indirizzo' => 'Via Prova 33',
                            'cap' => '98031',
                            'comune' => 'Capizzi',
                            'provincia' => 'ME',
                            'nazione' => 'IT',
                        ],
                    ],
                    'cessionario_committente' => [
                        'dati_anagrafici' => [
                            'id_fiscale_iva' => [
                                'id_paese' => 'IT',
                                'id_codice' => '15156930966',
                            ],
                            'anagrafica' => [
                                'denominazione' => 'ER FEZZONE SRL',
                            ],
                        ],
                        'sede' => [
                            'indirizzo' => 'Via Negrin',
                            'cap' => '36043',
                            'comune' => 'Camisano Vicentino',
                            'provincia' => 'VI',
                            'nazione' => 'IT',
                        ],
                    ],
                ],
                'fattura_elettronica_body' => [
                    [
                        'dati_generali' => [
                            'dati_generali_documento' => [
                                'tipo_documento' => 'TD01',
                                'divisa' => 'EUR',
                                'data' => '2025-12-22',
                                'numero' => '10TER',
                                'dati_bollo' => [
                                    'bollo_virtuale' => 'SI',
                                    'importo_bollo' => '2.00',
                                ],
                                'importo_totale_documento' => '1602.00',
                                'causale' => ['N Pratica 1/2025 N PAX 1 Intestatario ER FEZZONE SRL'],
                            ],
                        ],
                        'dati_beni_servizi' => [
                            'dettaglio_linee' => [
                                [
                                    'numero_linea' => 1,
                                    'descrizione' => 'Adeguamento carburante',
                                    'quantita' => '2.00000000',
                                    'prezzo_unitario' => '800.00000000',
                                    'prezzo_totale' => '1600.00000000',
                                    'aliquota_iva' => '0.00',
                                    'natura' => 'N5',
                                ],
                            ],
                            'dati_riepilogo' => [
                                [
                                    'aliquota_iva' => '0.00',
                                    'natura' => 'N5',
                                    'imponibile_importo' => '1600.00',
                                    'imposta' => '0.00',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];

    $dto = SupplierInvoiceWebhookDto::from($data);

    expect($dto)
        ->toBeInstanceOf(SupplierInvoiceWebhookDto::class)
        ->and($dto->invoice)->toBeInstanceOf(Fezz\Acube\Sdk\Italy\Webhooks\SupplierInvoice\SupplierInvoiceDto::class)
        ->and($dto->invoice->uuid)->toBe('019b47b3-155c-7d1b-93ca-56b63d5090c0')
        ->and($dto->invoice->created_at)->toBe('2025-12-22T20:14:37+00:00')
        ->and($dto->invoice->filename)->toBe('prova.xml')
        ->and($dto->invoice->file_id)->toBe('0')
        ->and($dto->invoice->payload)->toBeInstanceOf(Fezz\Acube\Sdk\Italy\Webhooks\SupplierInvoice\Payload\InvoicePayloadDto::class)
        ->and($dto->invoice->payload->fattura_elettronica_header)->toBeInstanceOf(Fezz\Acube\Sdk\Italy\Invoice\Dto\FatturaElettronicaHeaderDto::class)
        ->and($dto->invoice->payload->fattura_elettronica_header->dati_trasmissione['id_trasmittente']['id_paese'])->toBe('IT')
        ->and($dto->invoice->payload->fattura_elettronica_body)->toBeInstanceOf(Fezz\Acube\Sdk\Italy\Invoice\Dto\FatturaElettronicaBodyDto::class)
        ->and($dto->invoice->payload->fattura_elettronica_body->dati_generali['dati_generali_documento']['tipo_documento'])->toBe('TD01');
});

test('can create supplier invoice webhook dto from array with full payload', function (): void {
    $data = [
        'invoice' => [
            'uuid' => '019b47b3-155c-7d1b-93ca-56b63d5090c0',
            'created_at' => '2025-12-22T20:14:37+00:00',
            'filename' => 'prova.xml',
            'file_id' => '0',
            'payload' => [
                'fattura_elettronica_header' => [
                    'dati_trasmissione' => [
                        'id_trasmittente' => [
                            'id_paese' => 'IT',
                            'id_codice' => '04155930920',
                        ],
                        'progressivo_invio' => '10TER',
                        'formato_trasmissione' => 'FPR12',
                        'codice_destinatario' => '3C984HL',
                    ],
                    'cedente_prestatore' => [
                        'dati_anagrafici' => [
                            'id_fiscale_iva' => [
                                'id_paese' => 'IT',
                                'id_codice' => '04155930920',
                            ],
                            'codice_fiscale' => '04155930920',
                            'anagrafica' => [
                                'denominazione' => 'FEZZ SRL',
                            ],
                            'regime_fiscale' => 'RF11',
                        ],
                        'sede' => [
                            'indirizzo' => 'Via Prova 33',
                            'cap' => '98031',
                            'comune' => 'Capizzi',
                            'provincia' => 'ME',
                            'nazione' => 'IT',
                        ],
                    ],
                    'cessionario_committente' => [
                        'dati_anagrafici' => [
                            'id_fiscale_iva' => [
                                'id_paese' => 'IT',
                                'id_codice' => '15156930966',
                            ],
                            'anagrafica' => [
                                'denominazione' => 'ER FEZZONE SRL',
                            ],
                        ],
                        'sede' => [
                            'indirizzo' => 'Via Negrin',
                            'cap' => '36043',
                            'comune' => 'Camisano Vicentino',
                            'provincia' => 'VI',
                            'nazione' => 'IT',
                        ],
                    ],
                ],
                'fattura_elettronica_body' => [
                    [
                        'dati_generali' => [
                            'dati_generali_documento' => [
                                'tipo_documento' => 'TD01',
                                'divisa' => 'EUR',
                                'data' => '2025-12-22',
                                'numero' => '10TER',
                                'dati_bollo' => [
                                    'bollo_virtuale' => 'SI',
                                    'importo_bollo' => '2.00',
                                ],
                                'importo_totale_documento' => '1602.00',
                                'causale' => ['N Pratica 1/2025 N PAX 1 Intestatario ER FEZZONE SRL'],
                            ],
                        ],
                        'dati_beni_servizi' => [
                            'dettaglio_linee' => [
                                [
                                    'numero_linea' => 1,
                                    'descrizione' => 'Adeguamento carburante',
                                    'quantita' => '2.00000000',
                                    'prezzo_unitario' => '800.00000000',
                                    'prezzo_totale' => '1600.00000000',
                                    'aliquota_iva' => '0.00',
                                    'natura' => 'N5',
                                ],
                            ],
                            'dati_riepilogo' => [
                                [
                                    'aliquota_iva' => '0.00',
                                    'natura' => 'N5',
                                    'imponibile_importo' => '1600.00',
                                    'imposta' => '0.00',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];

    $dto = SupplierInvoiceWebhookDto::from($data);

    expect($dto)
        ->toBeInstanceOf(SupplierInvoiceWebhookDto::class)
        ->and($dto->invoice)->toBeInstanceOf(Fezz\Acube\Sdk\Italy\Webhooks\SupplierInvoice\SupplierInvoiceDto::class)
        ->and($dto->invoice->uuid)->toBe('019b47b3-155c-7d1b-93ca-56b63d5090c0')
        ->and($dto->invoice->created_at)->toBe('2025-12-22T20:14:37+00:00')
        ->and($dto->invoice->filename)->toBe('prova.xml')
        ->and($dto->invoice->file_id)->toBe('0')
        ->and($dto->invoice->payload)->toBeInstanceOf(Fezz\Acube\Sdk\Italy\Webhooks\SupplierInvoice\Payload\InvoicePayloadDto::class)
        ->and($dto->invoice->payload->fattura_elettronica_header)->toBeInstanceOf(Fezz\Acube\Sdk\Italy\Invoice\Dto\FatturaElettronicaHeaderDto::class)
        ->and($dto->invoice->payload->fattura_elettronica_header->dati_trasmissione['id_trasmittente']['id_paese'])->toBe('IT')
        ->and($dto->invoice->payload->fattura_elettronica_body)->toBeInstanceOf(Fezz\Acube\Sdk\Italy\Invoice\Dto\FatturaElettronicaBodyDto::class)
        ->and($dto->invoice->payload->fattura_elettronica_body->dati_generali['dati_generali_documento']['tipo_documento'])->toBe('TD01');
});

test('can create supplier invoice webhook dto with associative array body data', function (): void {
    // Test InvoicePayloadDto when bodyData is an associative array (not a list)
    $data = [
        'invoice' => [
            'uuid' => 'invoice-uuid-assoc',
            'created_at' => '2024-01-01T00:00:00Z',
            'filename' => 'assoc.xml',
            'file_id' => '4',
            'payload' => [
                'fattura_elettronica_header' => [
                    'dati_trasmissione' => [],
                    'cedente_prestatore' => [],
                    'cessionario_committente' => [],
                ],
                'fattura_elettronica_body' => [
                    // Associative array (not a list) - this tests lines 65-67
                    'dati_generali' => [
                        'dati_generali_documento' => [
                            'tipo_documento' => 'TD01',
                            'divisa' => 'EUR',
                        ],
                    ],
                    'dati_beni_servizi' => [],
                ],
            ],
        ],
    ];

    $dto = SupplierInvoiceWebhookDto::from($data);

    expect($dto)
        ->toBeInstanceOf(SupplierInvoiceWebhookDto::class)
        ->and($dto->invoice->uuid)->toBe('invoice-uuid-assoc')
        ->and($dto->invoice->payload->fattura_elettronica_body->dati_generali['dati_generali_documento']['tipo_documento'])->toBe('TD01');
});

test('can create supplier invoice webhook dto with minimal payload', function (): void {
    $data = [
        'invoice' => [
            'uuid' => 'invoice-uuid-123',
            'created_at' => '2024-01-01T00:00:00Z',
            'filename' => 'test.xml',
            'file_id' => '1',
            'payload' => [
                'fattura_elettronica_header' => [],
                'fattura_elettronica_body' => [],
            ],
        ],
    ];

    $dto = SupplierInvoiceWebhookDto::from($data);

    expect($dto)
        ->toBeInstanceOf(SupplierInvoiceWebhookDto::class)
        ->and($dto->invoice->uuid)->toBe('invoice-uuid-123')
        ->and($dto->invoice->filename)->toBe('test.xml')
        ->and($dto->invoice->file_id)->toBe('1')
        ->and($dto->invoice->payload->fattura_elettronica_header)->toBeInstanceOf(Fezz\Acube\Sdk\Italy\Invoice\Dto\FatturaElettronicaHeaderDto::class)
        ->and($dto->invoice->payload->fattura_elettronica_body)->toBeInstanceOf(Fezz\Acube\Sdk\Italy\Invoice\Dto\FatturaElettronicaBodyDto::class);
});

test('can create supplier invoice webhook dto with missing optional fields', function (): void {
    $data = [
        'invoice' => [
            'uuid' => 'invoice-uuid-456',
            'created_at' => '2024-01-01T00:00:00Z',
            'filename' => 'test.xml',
            'file_id' => '2',
        ],
    ];

    $dto = SupplierInvoiceWebhookDto::from($data);

    expect($dto)
        ->toBeInstanceOf(SupplierInvoiceWebhookDto::class)
        ->and($dto->invoice->uuid)->toBe('invoice-uuid-456')
        ->and($dto->invoice->payload->fattura_elettronica_header)->toBeInstanceOf(Fezz\Acube\Sdk\Italy\Invoice\Dto\FatturaElettronicaHeaderDto::class)
        ->and($dto->invoice->payload->fattura_elettronica_body)->toBeInstanceOf(Fezz\Acube\Sdk\Italy\Invoice\Dto\FatturaElettronicaBodyDto::class);
});

test('can create supplier invoice webhook dto when data has no invoice key', function (): void {
    // Test the case where data itself is the invoice (no 'invoice' key)
    $data = [
        'uuid' => 'invoice-uuid-789',
        'created_at' => '2024-01-01T00:00:00Z',
        'filename' => 'direct.xml',
        'file_id' => '3',
        'payload' => [
            'fattura_elettronica_header' => [],
            'fattura_elettronica_body' => [],
        ],
    ];

    $dto = SupplierInvoiceWebhookDto::from($data);

    expect($dto)
        ->toBeInstanceOf(SupplierInvoiceWebhookDto::class)
        ->and($dto->invoice->uuid)->toBe('invoice-uuid-789')
        ->and($dto->invoice->filename)->toBe('direct.xml')
        ->and($dto->invoice->file_id)->toBe('3');
});

test('can create supplier invoice webhook dto with non-array payload', function (): void {
    // Test SupplierInvoiceDto when payload is not an array (tests line 46)
    $data = [
        'invoice' => [
            'uuid' => 'invoice-uuid-non-array-payload',
            'created_at' => '2024-01-01T00:00:00Z',
            'filename' => 'test.xml',
            'file_id' => '5',
            'payload' => 'not-an-array', // Not an array - tests line 46
        ],
    ];

    $dto = SupplierInvoiceWebhookDto::from($data);

    expect($dto)
        ->toBeInstanceOf(SupplierInvoiceWebhookDto::class)
        ->and($dto->invoice->uuid)->toBe('invoice-uuid-non-array-payload')
        ->and($dto->invoice->payload)->toBeInstanceOf(Fezz\Acube\Sdk\Italy\Webhooks\SupplierInvoice\Payload\InvoicePayloadDto::class)
        ->and($dto->invoice->payload->fattura_elettronica_header)->toBeInstanceOf(Fezz\Acube\Sdk\Italy\Invoice\Dto\FatturaElettronicaHeaderDto::class)
        ->and($dto->invoice->payload->fattura_elettronica_body)->toBeInstanceOf(Fezz\Acube\Sdk\Italy\Invoice\Dto\FatturaElettronicaBodyDto::class);
});

