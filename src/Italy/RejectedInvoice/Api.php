<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\RejectedInvoice;

use Fezz\Acube\Sdk\BaseResource;
use Fezz\Acube\Sdk\Italy\RejectedInvoice\Dto\GetRejectedInvoicesCountRequestDto;
use Fezz\Acube\Sdk\Italy\RejectedInvoice\Dto\RecoverRejectedInvoicesRequestDto;
use Fezz\Acube\Sdk\Italy\RejectedInvoice\Requests\GetRejectedInvoicesCountRequest;
use Fezz\Acube\Sdk\Italy\RejectedInvoice\Requests\RecoverRejectedInvoicesRequest;
use Saloon\Http\Response;

/**
 * Rejected invoices API resource for the A-Cube Italy API.
 *
 * Provides methods for counting and recovering rejected supplier invoices
 * that were temporarily stored when supplier_invoice_enabled was disabled.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/rejected-invoices/
 */
final class Api extends BaseResource
{
    /**
     * Get the count of recoverable rejected invoices.
     *
     * Retrieves the count of rejected invoices that can be recovered within a date range.
     *
     * Endpoint: GET /rejected-invoices/{fiscalId}/count
     *
     * @param  GetRejectedInvoicesCountRequestDto  $dto  The request data including fiscal ID and optional query parameters
     * @return Response The HTTP response containing the count
     */
    public function count(GetRejectedInvoicesCountRequestDto $dto): Response
    {
        return $this->connector->send(new GetRejectedInvoicesCountRequest($dto));
    }

    /**
     * Start recovery of rejected invoices.
     *
     * Initiates the recovery process for rejected invoices within a date range.
     *
     * Endpoint: POST /rejected-invoices/{fiscalId}/recover
     *
     * @param  string  $fiscalId  The fiscal ID
     * @param  RecoverRejectedInvoicesRequestDto  $dto  The recovery request payload
     * @return Response The HTTP response containing the job UUID and count
     */
    public function recover(string $fiscalId, RecoverRejectedInvoicesRequestDto $dto): Response
    {
        return $this->connector->send(new RecoverRejectedInvoicesRequest($fiscalId, $dto));
    }
}
