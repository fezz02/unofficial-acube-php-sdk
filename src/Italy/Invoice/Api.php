<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice;

use Fezz\Acube\Sdk\BaseResource;
use Fezz\Acube\Sdk\Italy\Invoice\Dto\FatturaElettronicaDto;
use Fezz\Acube\Sdk\Italy\Invoice\Dto\FatturaElettronicaSemplificataDto;
use Fezz\Acube\Sdk\Italy\Invoice\Dto\GetInvoicesRequestDto;
use Fezz\Acube\Sdk\Italy\Invoice\Requests\GetInvoiceRequest;
use Fezz\Acube\Sdk\Italy\Invoice\Requests\GetInvoicesRequest;
use Fezz\Acube\Sdk\Italy\Invoice\Requests\SendInvoiceRequest;
use Fezz\Acube\Sdk\Italy\Invoice\Requests\SendInvoiceXmlRequest;
use Fezz\Acube\Sdk\Italy\Invoice\Requests\SendSimplifiedInvoiceRequest;
use Saloon\Http\Response;

/**
 * Invoices API resource for the A-Cube Italy API.
 *
 * Provides methods for composing, sending, and managing invoices in the Italian
 * e-invoicing system (FatturaPA).
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final class Api extends BaseResource
{
    /**
     * Send a standard invoice.
     *
     * Sends a FatturaPA invoice in JSON format. The invoice is processed asynchronously.
     *
     * Endpoint: POST /invoices
     *
     * @param  FatturaElettronicaDto|array<string, mixed>  $invoice  The invoice data (DTO or array)
     * @return Response The HTTP response containing the invoice UUID
     */
    public function send(FatturaElettronicaDto|array $invoice): Response
    {
        return $this->connector->send(new SendInvoiceRequest($invoice));
    }

    /**
     * Send an invoice in XML format.
     *
     * Sends a FatturaPA invoice in XML format. The invoice is processed asynchronously.
     *
     * Endpoint: POST /invoices/xml
     *
     * @param  string  $xml  The invoice data in XML format
     * @return Response The HTTP response containing the invoice UUID
     */
    public function sendXml(string $xml): Response
    {
        return $this->connector->send(new SendInvoiceXmlRequest($xml));
    }

    /**
     * Send a simplified invoice.
     *
     * Sends a simplified FatturaPA invoice in JSON format. Simplified invoices
     * are used for invoices with total amount ≤ 400€.
     *
     * Endpoint: POST /invoices/simplified
     *
     * @param  FatturaElettronicaSemplificataDto|array<string, mixed>  $invoice  The simplified invoice data (DTO or array)
     * @return Response The HTTP response containing the invoice UUID
     */
    public function sendSimplified(FatturaElettronicaSemplificataDto|array $invoice): Response
    {
        return $this->connector->send(new SendSimplifiedInvoiceRequest($invoice));
    }

    /**
     * List invoices.
     *
     * Retrieves a collection of invoices with optional filtering and pagination.
     *
     * Endpoint: GET /invoices
     *
     * @param  GetInvoicesRequestDto  $dto  The request data including optional query parameters
     * @return Response The HTTP response containing the list of invoices
     */
    public function list(GetInvoicesRequestDto $dto): Response
    {
        return $this->connector->send(new GetInvoicesRequest($dto));
    }

    /**
     * Get an invoice by UUID.
     *
     * Retrieves a specific invoice by its UUID.
     *
     * Endpoint: GET /invoices/{uuid}
     *
     * @param  string  $uuid  The invoice UUID
     * @return Response The HTTP response containing the invoice data
     */
    public function get(string $uuid): Response
    {
        return $this->connector->send(new GetInvoiceRequest($uuid));
    }

    /**
     * List draft invoices.
     *
     * Retrieves a collection of draft invoices with optional filtering.
     *
     * Endpoint: GET /invoices/draft
     *
     * @param  Dto\GetDraftInvoicesRequestDto  $dto  The request data including optional query parameters
     * @return Response The HTTP response containing the list of draft invoices
     */
    public function listDrafts(Dto\GetDraftInvoicesRequestDto $dto): Response
    {
        return $this->connector->send(new Requests\GetDraftInvoicesRequest($dto));
    }

    /**
     * Create a draft invoice.
     *
     * Creates a new invoice in draft mode. The invoice will not be sent to the SDI until it is explicitly requested.
     *
     * Endpoint: POST /invoices/draft
     *
     * @param  Dto\CreateDraftInvoiceRequestDto  $dto  The request data including invoice data
     * @return Response The HTTP response containing the created draft invoice
     */
    public function createDraft(Dto\CreateDraftInvoiceRequestDto $dto): Response
    {
        return $this->connector->send(new Requests\CreateDraftInvoiceRequest($dto));
    }

    /**
     * Get a draft invoice by ID.
     *
     * Retrieves a specific draft invoice by its ID.
     *
     * Endpoint: GET /invoices/draft/{id}
     *
     * @param  Dto\GetDraftInvoiceRequestDto  $dto  The request data including ID
     * @return Response The HTTP response containing the draft invoice data
     */
    public function getDraft(Dto\GetDraftInvoiceRequestDto $dto): Response
    {
        return $this->connector->send(new Requests\GetDraftInvoiceRequest($dto));
    }

    /**
     * Update a draft invoice.
     *
     * Updates the content of a draft invoice.
     *
     * Endpoint: PUT /invoices/draft/{id}
     *
     * @param  Dto\UpdateDraftInvoiceRequestDto  $dto  The request data including ID and invoice data
     * @return Response The HTTP response containing the updated draft invoice
     */
    public function updateDraft(Dto\UpdateDraftInvoiceRequestDto $dto): Response
    {
        return $this->connector->send(new Requests\UpdateDraftInvoiceRequest($dto));
    }

    /**
     * Delete a draft invoice.
     *
     * Deletes a draft invoice. All the contents will be completely removed from the platform.
     *
     * Endpoint: DELETE /invoices/draft/{id}
     *
     * @param  Dto\DeleteDraftInvoiceRequestDto  $dto  The request data including ID
     * @return Response The HTTP response (204 on success, 404 if not found, 409 if not in draft state)
     */
    public function deleteDraft(Dto\DeleteDraftInvoiceRequestDto $dto): Response
    {
        return $this->connector->send(new Requests\DeleteDraftInvoiceRequest($dto));
    }

    /**
     * Send a draft invoice.
     *
     * Accepts and sends a draft invoice to the SDI. The invoice will be validated and sent to the SDI.
     *
     * Endpoint: POST /invoices/draft/{id}/send
     *
     * @param  Dto\SendDraftInvoiceRequestDto  $dto  The request data including ID
     * @return Response The HTTP response containing the sent invoice
     */
    public function sendDraft(Dto\SendDraftInvoiceRequestDto $dto): Response
    {
        return $this->connector->send(new Requests\SendDraftInvoiceRequest($dto));
    }

    /**
     * Create a simplified draft invoice.
     *
     * Creates a new simplified invoice in draft mode. The invoice will not be sent to the SDI until it is explicitly requested.
     *
     * Endpoint: POST /invoices/simplified/draft
     *
     * @param  Dto\CreateSimplifiedDraftInvoiceRequestDto  $dto  The request data including invoice data
     * @return Response The HTTP response containing the created draft invoice
     */
    public function createSimplifiedDraft(Dto\CreateSimplifiedDraftInvoiceRequestDto $dto): Response
    {
        return $this->connector->send(new Requests\CreateSimplifiedDraftInvoiceRequest($dto));
    }

    /**
     * Update a simplified draft invoice.
     *
     * Updates the content of a simplified draft invoice.
     *
     * Endpoint: PUT /invoices/simplified/draft/{id}
     *
     * @param  Dto\UpdateSimplifiedDraftInvoiceRequestDto  $dto  The request data including ID and invoice data
     * @return Response The HTTP response containing the updated draft invoice
     */
    public function updateSimplifiedDraft(Dto\UpdateSimplifiedDraftInvoiceRequestDto $dto): Response
    {
        return $this->connector->send(new Requests\UpdateSimplifiedDraftInvoiceRequest($dto));
    }

    /**
     * Delete a simplified draft invoice.
     *
     * Deletes a simplified draft invoice. All the contents will be completely removed from the platform.
     *
     * Endpoint: DELETE /invoices/simplified/draft/{id}
     *
     * @param  Dto\DeleteSimplifiedDraftInvoiceRequestDto  $dto  The request data including ID
     * @return Response The HTTP response (204 on success, 404 if not found, 409 if not in draft state)
     */
    public function deleteSimplifiedDraft(Dto\DeleteSimplifiedDraftInvoiceRequestDto $dto): Response
    {
        return $this->connector->send(new Requests\DeleteSimplifiedDraftInvoiceRequest($dto));
    }

    /**
     * Send a simplified draft invoice.
     *
     * Accepts and sends a simplified draft invoice to the SDI. The invoice will be validated and sent to the SDI.
     *
     * Endpoint: POST /invoices/simplified/draft/{id}/send
     *
     * @param  Dto\SendSimplifiedDraftInvoiceRequestDto  $dto  The request data including ID
     * @return Response The HTTP response containing the sent invoice
     */
    public function sendSimplifiedDraft(Dto\SendSimplifiedDraftInvoiceRequestDto $dto): Response
    {
        return $this->connector->send(new Requests\SendSimplifiedDraftInvoiceRequest($dto));
    }

    /**
     * Validate an invoice.
     *
     * Validates an invoice without sending it to the SDI.
     *
     * Endpoint: POST /invoices/validate
     *
     * @param  Dto\ValidateInvoiceRequestDto  $dto  The request data including invoice data
     * @return Response The HTTP response containing the validation result
     */
    public function validate(Dto\ValidateInvoiceRequestDto $dto): Response
    {
        return $this->connector->send(new Requests\ValidateInvoiceRequest($dto));
    }

    /**
     * Validate a simplified invoice.
     *
     * Validates a simplified invoice without sending it to the SDI.
     *
     * Endpoint: POST /invoices/simplified/validate
     *
     * @param  Dto\ValidateSimplifiedInvoiceRequestDto  $dto  The request data including invoice data
     * @return Response The HTTP response containing the validation result
     */
    public function validateSimplified(Dto\ValidateSimplifiedInvoiceRequestDto $dto): Response
    {
        return $this->connector->send(new Requests\ValidateSimplifiedInvoiceRequest($dto));
    }

    /**
     * Convert an invoice between formats.
     *
     * Converts an invoice between JSON and XML formats.
     *
     * Endpoint: POST /invoices/convert
     *
     * @param  Dto\ConvertInvoiceRequestDto  $dto  The request data including invoice data
     * @return Response The HTTP response containing the converted invoice
     */
    public function convert(Dto\ConvertInvoiceRequestDto $dto): Response
    {
        return $this->connector->send(new Requests\ConvertInvoiceRequest($dto));
    }

    /**
     * Mark invoices as downloaded.
     *
     * Sets the downloaded flag for a collection of invoices.
     *
     * Endpoint: POST /invoices/downloaded
     *
     * @param  Dto\MarkInvoicesDownloadedRequestDto  $dto  The request data including invoice UUIDs
     * @return Response The HTTP response
     */
    public function markDownloaded(Dto\MarkInvoicesDownloadedRequestDto $dto): Response
    {
        return $this->connector->send(new Requests\MarkInvoicesDownloadedRequest($dto));
    }

    /**
     * Get invoice statistics.
     *
     * Retrieves statistic information about invoices for a specific year.
     *
     * Endpoint: GET /invoices/stats/{year}
     *
     * @param  Dto\GetInvoiceStatsRequestDto  $dto  The request data including year and optional fiscal_id
     * @return Response The HTTP response containing the invoice statistics
     */
    public function getStats(Dto\GetInvoiceStatsRequestDto $dto): Response
    {
        return $this->connector->send(new Requests\GetInvoiceStatsRequest($dto));
    }

    /**
     * Get invoice report.
     *
     * Retrieves an invoice report.
     *
     * Endpoint: GET /invoices/report
     *
     * @param  Dto\GetInvoiceReportRequestDto  $dto  The request data including optional query parameters
     * @return Response The HTTP response containing the invoice report
     */
    public function getReport(Dto\GetInvoiceReportRequestDto $dto): Response
    {
        return $this->connector->send(new Requests\GetInvoiceReportRequest($dto));
    }

    /**
     * Send an extra SDI invoice.
     *
     * Creates a new extra SDI invoice.
     *
     * Endpoint: POST /invoices/extra-sdi
     *
     * @param  Dto\SendExtraSdiInvoiceRequestDto  $dto  The request data including invoice data
     * @return Response The HTTP response containing the invoice UUID
     */
    public function sendExtraSdi(Dto\SendExtraSdiInvoiceRequestDto $dto): Response
    {
        return $this->connector->send(new Requests\SendExtraSdiInvoiceRequest($dto));
    }

    /**
     * Archive a rejected invoice.
     *
     * Marks a rejected invoice as archived and removes it from the rejected list to be fixed.
     *
     * Endpoint: PUT /invoices/{id}/archive-rejected
     *
     * @param  Dto\ArchiveRejectedInvoiceRequestDto  $dto  The request data including ID
     * @return Response The HTTP response (204 on success, 404 if not found, 409 if not in rejected state)
     */
    public function archiveRejected(Dto\ArchiveRejectedInvoiceRequestDto $dto): Response
    {
        return $this->connector->send(new Requests\ArchiveRejectedInvoiceRequest($dto));
    }

    /**
     * Get invoice notifications.
     *
     * Retrieves the collection of notifications for an invoice.
     *
     * Endpoint: GET /invoices/{uuid}/notifications
     *
     * @param  Dto\GetInvoiceNotificationsRequestDto  $dto  The request data including UUID
     * @return Response The HTTP response containing the list of notifications
     */
    public function getNotifications(Dto\GetInvoiceNotificationsRequestDto $dto): Response
    {
        return $this->connector->send(new Requests\GetInvoiceNotificationsRequest($dto));
    }

    /**
     * Notify invoice webhook.
     *
     * Triggers a webhook notification for an invoice.
     *
     * Endpoint: POST /invoices/{id}/notify
     *
     * @param  Dto\NotifyInvoiceRequestDto  $dto  The request data including ID
     * @return Response The HTTP response
     */
    public function notify(Dto\NotifyInvoiceRequestDto $dto): Response
    {
        return $this->connector->send(new Requests\NotifyInvoiceRequest($dto));
    }

    /**
     * Notify invoice notifications webhook.
     *
     * Triggers a webhook notification for invoice notifications.
     *
     * Endpoint: POST /invoices/{id}/notifications/notify
     *
     * @param  Dto\NotifyInvoiceRequestDto  $dto  The request data including ID
     * @return Response The HTTP response
     */
    public function notifyNotifications(Dto\NotifyInvoiceRequestDto $dto): Response
    {
        return $this->connector->send(new Requests\NotifyInvoiceNotificationsRequest($dto));
    }

    /**
     * Preserve an invoice.
     *
     * Sends an invoice to the legal storage.
     *
     * Endpoint: POST /invoices/{uuid}/preserve
     *
     * @param  Dto\PreserveInvoiceRequestDto  $dto  The request data including UUID
     * @return Response The HTTP response
     */
    public function preserve(Dto\PreserveInvoiceRequestDto $dto): Response
    {
        return $this->connector->send(new Requests\PreserveInvoiceRequest($dto));
    }

    /**
     * Get an invoice attachment.
     *
     * Downloads the index-th attachment of an invoice.
     *
     * Endpoint: GET /invoices/{uuid}/attachments/{index}
     *
     * @param  Dto\GetInvoiceAttachmentRequestDto  $dto  The request data including UUID and index
     * @return Response The HTTP response containing the attachment file content
     */
    public function getAttachment(Dto\GetInvoiceAttachmentRequestDto $dto): Response
    {
        return $this->connector->send(new Requests\GetInvoiceAttachmentRequest($dto));
    }

    /**
     * Get an invoice preserved document.
     *
     * Retrieves the preserved document for an invoice.
     *
     * Endpoint: GET /invoices/{id}/preserved-document
     *
     * @param  Dto\GetInvoicePreservedDocumentRequestDto  $dto  The request data including ID
     * @return Response The HTTP response containing the preserved document data
     */
    public function getPreservedDocument(Dto\GetInvoicePreservedDocumentRequestDto $dto): Response
    {
        return $this->connector->send(new Requests\GetInvoicePreservedDocumentRequest($dto));
    }
}
