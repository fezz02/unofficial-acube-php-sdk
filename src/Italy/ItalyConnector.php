<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy;

use Fezz\Acube\Sdk\AcubeApi;

/**
 * Connector for the A-Cube Italy API.
 *
 * The Italy API provides endpoints specific to Italian e-invoicing operations,
 * including SDI (Sistema di Interscambio) integration and Italian tax compliance.
 *
 * Base URLs:
 * - Production: https://api.acubeapi.com
 * - Sandbox: https://api-sandbox.acubeapi.com
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/
 */
final class ItalyConnector extends AcubeApi
{
    /**
     * Get the invoices API resource.
     *
     * Provides methods for composing, sending, and managing invoices.
     *
     * @return Invoice\Api The invoices API resource
     *
     * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
     */
    public function invoices(): Invoice\Api
    {
        return new Invoice\Api($this);
    }

    /**
     * Get the invoice imports API resource.
     *
     * Provides methods for importing customer and supplier invoices.
     *
     * @return InvoiceImport\Api The invoice imports API resource
     *
     * @see https://docs.acubeapi.com/documentation/gov-it/invoice-imports/
     */
    public function invoiceImports(): InvoiceImport\Api
    {
        return new InvoiceImport\Api($this);
    }

    /**
     * Get the rejected invoices API resource.
     *
     * Provides methods for counting and recovering rejected invoices.
     *
     * @return RejectedInvoice\Api The rejected invoices API resource
     *
     * @see https://docs.acubeapi.com/documentation/gov-it/rejected-invoices/
     */
    public function rejectedInvoices(): RejectedInvoice\Api
    {
        return new RejectedInvoice\Api($this);
    }

    /**
     * Get the invoice extract API resource.
     *
     * Provides methods for extracting invoice information from PDF files.
     *
     * @return InvoiceExtract\Api The invoice extract API resource
     *
     * @see https://docs.acubeapi.com/documentation/gov-it/invoice-extract/
     */
    public function invoiceExtract(): InvoiceExtract\Api
    {
        return new InvoiceExtract\Api($this);
    }

    /**
     * Get the numbering sequences API resource.
     *
     * Provides methods for managing numbering sequences for automatic invoice numbering.
     *
     * @return NumberingSequence\Api The numbering sequences API resource
     *
     * @see https://docs.acubeapi.com/documentation/gov-it/numbering-sequences/
     */
    public function numberingSequences(): NumberingSequence\Api
    {
        return new NumberingSequence\Api($this);
    }

    /**
     * Get the Cassetto Fiscale API resource.
     *
     * Provides methods for scheduling and managing invoice downloads from
     * the "Cassetto Fiscale" (Italian tax authority's digital mailbox).
     *
     * @return CassettoFiscale\Api The Cassetto Fiscale API resource
     *
     * @see https://docs.acubeapi.com/documentation/gov-it/cassetto-fiscale/
     */
    public function cassettoFiscale(): CassettoFiscale\Api
    {
        return new CassettoFiscale\Api($this);
    }

    /**
     * Get the invoice transfers API resource.
     *
     * Provides methods for managing invoice transfers.
     *
     * @return InvoiceTransfer\Api The invoice transfers API resource
     *
     * @see https://docs.acubeapi.com/documentation/gov-it/invoice-transfers/
     */
    public function invoiceTransfers(): InvoiceTransfer\Api
    {
        return new InvoiceTransfer\Api($this);
    }

    /**
     * Get the notifications API resource.
     *
     * Provides methods for managing invoice notifications.
     *
     * @return Notification\Api The notifications API resource
     *
     * @see https://docs.acubeapi.com/documentation/gov-it/notifications/
     */
    public function notifications(): Notification\Api
    {
        return new Notification\Api($this);
    }

    /**
     * Get the preserved documents API resource.
     *
     * Provides methods for managing preserved documents in legal storage.
     *
     * @return PreservedDocument\Api The preserved documents API resource
     *
     * @see https://docs.acubeapi.com/documentation/gov-it/preserved-documents/
     */
    public function preservedDocuments(): PreservedDocument\Api
    {
        return new PreservedDocument\Api($this);
    }

    /**
     * Get the receipts API resource.
     *
     * Provides methods for managing electronic receipts (ricevute fiscali elettroniche).
     *
     * @return Receipt\Api The receipts API resource
     *
     * @see https://docs.acubeapi.com/documentation/gov-it/receipts/
     */
    public function receipts(): Receipt\Api
    {
        return new Receipt\Api($this);
    }

    /**
     * Get the user API resource.
     *
     * Provides methods for managing user settings.
     *
     * @return User\Api The user API resource
     *
     * @see https://docs.acubeapi.com/documentation/gov-it/users/
     */
    public function user(): User\Api
    {
        return new User\Api($this);
    }

    /**
     * Get the verify API resource.
     *
     * Provides methods for verifying companies, fiscal IDs, persons, and split payment status.
     *
     * @return Verify\Api The verify API resource
     *
     * @see https://docs.acubeapi.com/documentation/gov-it/verify/
     */
    public function verify(): Verify\Api
    {
        return new Verify\Api($this);
    }

    /**
     * Get the business registry API resource.
     *
     * Provides methods for managing business registry entries and business registry configurations.
     *
     * @return BusinessRegistry\Api The business registry API resource
     *
     * @see https://docs.acubeapi.com/documentation/gov-it/business-registry/
     */
    public function businessRegistry(): BusinessRegistry\Api
    {
        return new BusinessRegistry\Api($this);
    }

    /**
     * Get the API configurations API resource.
     *
     * Provides methods for managing API configurations used for webhooks and integrations.
     *
     * @return ApiConfiguration\Api The API configurations API resource
     *
     * @see https://docs.acubeapi.com/documentation/gov-it/
     */
    public function apiConfigurations(): ApiConfiguration\Api
    {
        return new ApiConfiguration\Api($this);
    }

    /**
     * Get the simulation API resource.
     *
     * Provides methods for simulating invoices, notifications, and legal storage events.
     *
     * @return Simulate\Api The simulation API resource
     *
     * @see https://docs.acubeapi.com/documentation/gov-it/simulate/
     */
    public function simulate(): Simulate\Api
    {
        return new Simulate\Api($this);
    }
}
