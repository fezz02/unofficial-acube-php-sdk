<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\CassettoFiscale\Api as CassettoFiscaleApi;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\Invoice\Api as InvoiceApi;
use Fezz\Acube\Sdk\Italy\InvoiceExtract\Api as InvoiceExtractApi;
use Fezz\Acube\Sdk\Italy\InvoiceImport\Api as InvoiceImportApi;
use Fezz\Acube\Sdk\Italy\InvoiceTransfer\Api as InvoiceTransferApi;
use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Fezz\Acube\Sdk\Italy\Notification\Api as NotificationApi;
use Fezz\Acube\Sdk\Italy\NumberingSequence\Api as NumberingSequenceApi;
use Fezz\Acube\Sdk\Italy\PreservedDocument\Api as PreservedDocumentApi;
use Fezz\Acube\Sdk\Italy\Receipt\Api as ReceiptApi;
use Fezz\Acube\Sdk\Italy\Simulate\Api as SimulateApi;
use Fezz\Acube\Sdk\Italy\User\Api as UserApi;
use Fezz\Acube\Sdk\Italy\Verify\Api as VerifyApi;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Api as BusinessRegistryApi;
use Fezz\Acube\Sdk\Italy\ApiConfiguration\Api as ApiConfigurationApi;

test('italy connector exposes all italy api resources', function (): void {
    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);

    expect($connector->invoices())->toBeInstanceOf(InvoiceApi::class)
        ->and($connector->invoiceImports())->toBeInstanceOf(InvoiceImportApi::class)
        ->and($connector->rejectedInvoices())->toBeInstanceOf(\Fezz\Acube\Sdk\Italy\RejectedInvoice\Api::class)
        ->and($connector->invoiceExtract())->toBeInstanceOf(InvoiceExtractApi::class)
        ->and($connector->numberingSequences())->toBeInstanceOf(NumberingSequenceApi::class)
        ->and($connector->cassettoFiscale())->toBeInstanceOf(CassettoFiscaleApi::class)
        ->and($connector->invoiceTransfers())->toBeInstanceOf(InvoiceTransferApi::class)
        ->and($connector->notifications())->toBeInstanceOf(NotificationApi::class)
        ->and($connector->preservedDocuments())->toBeInstanceOf(PreservedDocumentApi::class)
        ->and($connector->receipts())->toBeInstanceOf(ReceiptApi::class)
        ->and($connector->user())->toBeInstanceOf(UserApi::class)
        ->and($connector->verify())->toBeInstanceOf(VerifyApi::class)
        ->and($connector->businessRegistry())->toBeInstanceOf(BusinessRegistryApi::class)
        ->and($connector->apiConfigurations())->toBeInstanceOf(ApiConfigurationApi::class)
        ->and($connector->simulate())->toBeInstanceOf(SimulateApi::class);
});
