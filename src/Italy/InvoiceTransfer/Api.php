<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\InvoiceTransfer;

use Fezz\Acube\Sdk\BaseResource;
use Fezz\Acube\Sdk\Italy\InvoiceTransfer\Dto\DownloadInvoiceTransferRequestDto;
use Fezz\Acube\Sdk\Italy\InvoiceTransfer\Dto\GetInvoiceTransferRequestDto;
use Fezz\Acube\Sdk\Italy\InvoiceTransfer\Dto\GetInvoiceTransfersRequestDto;
use Fezz\Acube\Sdk\Italy\InvoiceTransfer\Requests\DownloadInvoiceTransferRequest;
use Fezz\Acube\Sdk\Italy\InvoiceTransfer\Requests\GetInvoiceTransferRequest;
use Fezz\Acube\Sdk\Italy\InvoiceTransfer\Requests\GetInvoiceTransfersRequest;
use Saloon\Http\Response;

/**
 * Invoice transfers API resource for the A-Cube Italy API.
 *
 * Provides methods for managing invoice transfers.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoice-transfers/
 */
final class Api extends BaseResource
{
    /**
     * List invoice transfers.
     *
     * Retrieves a collection of invoice transfers with optional filtering and pagination.
     *
     * Endpoint: GET /invoice-transfers
     *
     * @param  GetInvoiceTransfersRequestDto  $dto  The request data including optional query parameters
     * @return Response The HTTP response containing the list of invoice transfers
     */
    public function list(GetInvoiceTransfersRequestDto $dto): Response
    {
        return $this->connector->send(new GetInvoiceTransfersRequest($dto));
    }

    /**
     * Get an invoice transfer by ID.
     *
     * Retrieves a specific invoice transfer by its ID.
     *
     * Endpoint: GET /invoice-transfers/{id}
     *
     * @param  GetInvoiceTransferRequestDto  $dto  The request data including ID
     * @return Response The HTTP response containing the invoice transfer data
     */
    public function get(GetInvoiceTransferRequestDto $dto): Response
    {
        return $this->connector->send(new GetInvoiceTransferRequest($dto));
    }

    /**
     * Download an invoice transfer file.
     *
     * Downloads the file associated with an invoice transfer.
     *
     * Endpoint: GET /invoice-transfers/{id}/download
     *
     * @param  DownloadInvoiceTransferRequestDto  $dto  The request data including ID
     * @return Response The HTTP response containing the file content
     */
    public function download(DownloadInvoiceTransferRequestDto $dto): Response
    {
        return $this->connector->send(new DownloadInvoiceTransferRequest($dto));
    }
}
