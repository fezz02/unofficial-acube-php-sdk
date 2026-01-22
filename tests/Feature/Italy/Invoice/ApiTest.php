<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\AcubeApi;
use Fezz\Acube\Sdk\Concerns\InvoiceMarking;
use Fezz\Acube\Sdk\Italy\Invoice\Dto\FatturaElettronicaBodyDto;
use Fezz\Acube\Sdk\Italy\Invoice\Dto\FatturaElettronicaDto;
use Fezz\Acube\Sdk\Italy\Invoice\Dto\FatturaElettronicaHeaderDto;
use Fezz\Acube\Sdk\Italy\Invoice\Dto\FatturaElettronicaSemplificataDto;
use Fezz\Acube\Sdk\Italy\Invoice\Dto\GetInvoicesRequestDto;
use Fezz\Acube\Sdk\Italy\Invoice\Dto\SendInvoiceResponseDto;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('can send standard invoice', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->invoices();

    $header = new FatturaElettronicaHeaderDto(
        dati_trasmissione: ['codice_destinatario' => 'ABCDEFG'],
        cedente_prestatore: ['dati_anagrafici' => ['id_fiscale_iva' => ['id_paese' => 'IT', 'id_codice' => '12345678901']]],
        cessionario_committente: ['dati_anagrafici' => ['codice_fiscale' => 'ABSDVFCNSHBGAFTS']]
    );
    $body = new FatturaElettronicaBodyDto(
        dati_generali: ['dati_generali_documento' => ['tipo_documento' => 'TD01', 'divisa' => 'EUR', 'data' => '2025-01-15', 'numero' => 'INV-001']],
        dati_beni_servizi: []
    );
    $invoice = new FatturaElettronicaDto($header, [$body]);

    $mockData = [
        'uuid' => 'invoice-uuid-123',
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 201),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->send($invoice);
    $responseDto = $response->dto();

    expect($responseDto)
        ->toBeInstanceOf(Fezz\Acube\Sdk\Italy\Invoice\Dto\SendInvoiceResponseDto::class)
        ->and($responseDto->uuid)->toBe('invoice-uuid-123');
});

test('can send xml invoice', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->invoices();

    $xml = '<FatturaElettronica>test</FatturaElettronica>';

    $mockData = [
        'uuid' => 'invoice-xml-uuid-123',
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 201),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->sendXml($xml);
    $responseDto = $response->dto();

    expect($responseDto)
        ->toBeInstanceOf(SendInvoiceResponseDto::class)
        ->and($responseDto->uuid)->toBe('invoice-xml-uuid-123');
});

test('can send simplified invoice', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->invoices();

    $invoice = new FatturaElettronicaSemplificataDto(
        fattura_elettronica_header: [],
        fattura_elettronica_body: []
    );

    $mockData = [
        'uuid' => 'invoice-uuid-456',
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 201),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->sendSimplified($invoice);
    $responseDto = $response->dto();

    expect($responseDto)
        ->toBeInstanceOf(Fezz\Acube\Sdk\Italy\Invoice\Dto\SendInvoiceResponseDto::class)
        ->and($responseDto->uuid)->toBe('invoice-uuid-456');
});

test('can list invoices', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->invoices();

    $dto = new GetInvoicesRequestDto(query: ['page' => 1]);

    $mockData = [
        [
            'uuid' => 'invoice-1',
            'marking' => 'sent',
            'notice' => null,
        ],
        [
            'uuid' => 'invoice-2',
            'marking' => 'waiting',
            'notice' => null,
        ],
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->list($dto);
    $responseDto = $response->dto();

    expect($responseDto)
        ->toBeInstanceOf(Fezz\Acube\Sdk\Italy\Invoice\Dto\GetInvoicesResponseDto::class)
        ->and($responseDto->invoices)->toHaveCount(2);
});

test('can get invoice by uuid', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->invoices();

    $mockData = [
        'uuid' => 'invoice-uuid-123',
        'marking' => 'sent',
        'notice' => 'Invoice sent successfully',
        'additional_fields' => [],
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->get('invoice-uuid-123');
    $responseDto = $response->dto();

    expect($responseDto)
        ->toBeInstanceOf(Fezz\Acube\Sdk\Italy\Invoice\Dto\InvoiceDto::class)
        ->and($responseDto->uuid)->toBe('invoice-uuid-123')
        ->and($responseDto->marking)->toBe(InvoiceMarking::SENT);
});

test('can list draft invoices', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->invoices();

    $dto = new Fezz\Acube\Sdk\Italy\Invoice\Dto\GetDraftInvoicesRequestDto(query: []);

    $mockData = [
        [
            'id' => 'draft-1',
            'uuid' => 'uuid-1',
        ],
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->listDrafts($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('can create draft invoice', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->invoices();

    $dto = new Fezz\Acube\Sdk\Italy\Invoice\Dto\CreateDraftInvoiceRequestDto(invoice: []);

    $mockData = [
        'id' => 'draft-123',
        'uuid' => 'uuid-123',
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 201),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->createDraft($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(201);
});

test('can get draft invoice', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->invoices();

    $dto = new Fezz\Acube\Sdk\Italy\Invoice\Dto\GetDraftInvoiceRequestDto(id: 'draft-123');

    $mockData = [
        'id' => 'draft-123',
        'uuid' => 'uuid-123',
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->getDraft($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('can update draft invoice', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->invoices();

    $dto = new Fezz\Acube\Sdk\Italy\Invoice\Dto\UpdateDraftInvoiceRequestDto(id: 'draft-123', invoice: []);

    $mockData = [
        'id' => 'draft-123',
        'uuid' => 'uuid-123',
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->updateDraft($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('can delete draft invoice', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->invoices();

    $dto = new Fezz\Acube\Sdk\Italy\Invoice\Dto\DeleteDraftInvoiceRequestDto(id: 'draft-123');

    $mockClient = new MockClient([
        MockResponse::make('', 204),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->deleteDraft($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(204);
});

test('can send draft invoice', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->invoices();

    $dto = new Fezz\Acube\Sdk\Italy\Invoice\Dto\SendDraftInvoiceRequestDto(id: 'draft-123');

    $mockData = [
        'uuid' => 'invoice-uuid-123',
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->sendDraft($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('can create simplified draft invoice', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->invoices();

    $dto = new Fezz\Acube\Sdk\Italy\Invoice\Dto\CreateSimplifiedDraftInvoiceRequestDto(invoice: []);

    $mockData = [
        'id' => 'draft-simplified-123',
        'uuid' => 'uuid-123',
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 201),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->createSimplifiedDraft($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(201);
});

test('can update simplified draft invoice', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->invoices();

    $dto = new Fezz\Acube\Sdk\Italy\Invoice\Dto\UpdateSimplifiedDraftInvoiceRequestDto(id: 'draft-123', invoice: []);

    $mockData = [
        'id' => 'draft-123',
        'uuid' => 'uuid-123',
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->updateSimplifiedDraft($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('can delete simplified draft invoice', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->invoices();

    $dto = new Fezz\Acube\Sdk\Italy\Invoice\Dto\DeleteSimplifiedDraftInvoiceRequestDto(id: 'draft-123');

    $mockClient = new MockClient([
        MockResponse::make('', 204),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->deleteSimplifiedDraft($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(204);
});

test('can send simplified draft invoice', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->invoices();

    $dto = new Fezz\Acube\Sdk\Italy\Invoice\Dto\SendSimplifiedDraftInvoiceRequestDto(id: 'draft-123');

    $mockData = [
        'uuid' => 'invoice-uuid-123',
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->sendSimplifiedDraft($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('can validate invoice', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->invoices();

    $dto = new Fezz\Acube\Sdk\Italy\Invoice\Dto\ValidateInvoiceRequestDto(invoice: []);

    $mockData = [
        'valid' => true,
        'errors' => [],
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->validate($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('can validate simplified invoice', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->invoices();

    $dto = new Fezz\Acube\Sdk\Italy\Invoice\Dto\ValidateSimplifiedInvoiceRequestDto(invoice: []);

    $mockData = [
        'valid' => true,
        'errors' => [],
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->validateSimplified($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('can convert invoice', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->invoices();

    $dto = new Fezz\Acube\Sdk\Italy\Invoice\Dto\ConvertInvoiceRequestDto(invoice: []);

    $mockData = '<?xml version="1.0"?><invoice></invoice>';

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200, ['Content-Type' => 'application/xml']),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->convert($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('can mark invoices as downloaded', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->invoices();

    $dto = new Fezz\Acube\Sdk\Italy\Invoice\Dto\MarkInvoicesDownloadedRequestDto(uuids: ['uuid-1', 'uuid-2']);

    $mockClient = new MockClient([
        MockResponse::make('', 204),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->markDownloaded($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(204);
});

test('can get invoice stats', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->invoices();

    $dto = new Fezz\Acube\Sdk\Italy\Invoice\Dto\GetInvoiceStatsRequestDto(year: '2024');

    $mockData = [
        'total' => 100,
        'sent' => 80,
        'received' => 20,
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->getStats($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('can get invoice report', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->invoices();

    $dto = new Fezz\Acube\Sdk\Italy\Invoice\Dto\GetInvoiceReportRequestDto(query: []);

    $mockData = 'CSV report content';

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200, ['Content-Type' => 'text/csv']),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->getReport($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('can send extra sdi invoice', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->invoices();

    $dto = new Fezz\Acube\Sdk\Italy\Invoice\Dto\SendExtraSdiInvoiceRequestDto(invoice: []);

    $mockData = [
        'uuid' => 'extra-sdi-uuid-123',
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 201),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->sendExtraSdi($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(201);
});

test('can archive rejected invoice', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->invoices();

    $dto = new Fezz\Acube\Sdk\Italy\Invoice\Dto\ArchiveRejectedInvoiceRequestDto(id: 'invoice-123');

    $mockClient = new MockClient([
        MockResponse::make('', 204),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->archiveRejected($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(204);
});

test('can get invoice notifications', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->invoices();

    $dto = new Fezz\Acube\Sdk\Italy\Invoice\Dto\GetInvoiceNotificationsRequestDto(uuid: 'invoice-uuid-123');

    $mockData = [
        [
            'uuid' => 'notification-1',
            'type' => 'NS',
        ],
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->getNotifications($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('can notify invoice', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->invoices();

    $dto = new Fezz\Acube\Sdk\Italy\Invoice\Dto\NotifyInvoiceRequestDto(id: 'invoice-123');

    $mockClient = new MockClient([
        MockResponse::make('', 204),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->notify($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(204);
});

test('can notify invoice notifications', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->invoices();

    $dto = new Fezz\Acube\Sdk\Italy\Invoice\Dto\NotifyInvoiceRequestDto(id: 'invoice-123');

    $mockClient = new MockClient([
        MockResponse::make('', 204),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->notifyNotifications($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(204);
});

test('can preserve invoice', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->invoices();

    $dto = new Fezz\Acube\Sdk\Italy\Invoice\Dto\PreserveInvoiceRequestDto(uuid: 'invoice-uuid-123');

    $mockClient = new MockClient([
        MockResponse::make('', 204),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->preserve($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(204);
});

test('can get invoice attachment', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->invoices();

    $dto = new Fezz\Acube\Sdk\Italy\Invoice\Dto\GetInvoiceAttachmentRequestDto(uuid: 'invoice-uuid-123', index: 0);

    $mockData = 'PDF attachment content';

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200, ['Content-Type' => 'application/pdf']),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->getAttachment($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('can get invoice preserved document', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->invoices();

    $dto = new Fezz\Acube\Sdk\Italy\Invoice\Dto\GetInvoicePreservedDocumentRequestDto(id: 'invoice-123');

    $mockData = [
        'id' => 'preserved-doc-123',
        'uuid' => 'uuid-123',
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->getPreservedDocument($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});
