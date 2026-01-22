<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Receipt;

use Fezz\Acube\Sdk\BaseResource;
use Fezz\Acube\Sdk\Italy\Receipt\Dto\CreateReceiptRequestDto;
use Fezz\Acube\Sdk\Italy\Receipt\Dto\GetReceiptsRequestDto;
use Fezz\Acube\Sdk\Italy\Receipt\Dto\ReturnReceiptRequestDto;
use Fezz\Acube\Sdk\Italy\Receipt\Requests\CreateReceiptRequest;
use Fezz\Acube\Sdk\Italy\Receipt\Requests\DeleteReceiptRequest;
use Fezz\Acube\Sdk\Italy\Receipt\Requests\GetReceiptDetailsRequest;
use Fezz\Acube\Sdk\Italy\Receipt\Requests\GetReceiptRequest;
use Fezz\Acube\Sdk\Italy\Receipt\Requests\GetReceiptsRequest;
use Fezz\Acube\Sdk\Italy\Receipt\Requests\ReturnReceiptRequest;
use Saloon\Http\Response;

/**
 * Receipts API resource for the A-Cube Italy API.
 *
 * Provides methods for managing electronic receipts (ricevute fiscali elettroniche).
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/receipts/
 */
final class Api extends BaseResource
{
    /**
     * List receipts.
     *
     * Retrieves a collection of electronic receipts with optional filtering and pagination.
     *
     * Endpoint: GET /receipts
     *
     * @param  GetReceiptsRequestDto  $dto  The request data including optional query parameters
     * @return Response The HTTP response containing the list of receipts
     */
    public function list(GetReceiptsRequestDto $dto): Response
    {
        return $this->connector->send(new GetReceiptsRequest($dto));
    }

    /**
     * Create a receipt.
     *
     * Creates a new electronic receipt.
     *
     * Endpoint: POST /receipts
     *
     * @param  CreateReceiptRequestDto  $dto  The request data including receipt data
     * @return Response The HTTP response containing the created receipt
     */
    public function create(CreateReceiptRequestDto $dto): Response
    {
        return $this->connector->send(new CreateReceiptRequest($dto));
    }

    /**
     * Get a receipt by ID.
     *
     * Retrieves a specific receipt by its ID.
     *
     * Endpoint: GET /receipts/{id}
     *
     * @param  string  $id  The ID of the receipt to retrieve
     * @return Response The HTTP response containing the receipt data
     */
    public function get(string $id): Response
    {
        return $this->connector->send(new GetReceiptRequest($id));
    }

    /**
     * Get receipt details or PDF.
     *
     * Retrieves the details of a receipt, or the PDF itself if Accept: application/pdf header is sent.
     *
     * Endpoint: GET /receipts/{id}/details
     *
     * @param  string  $id  The ID of the receipt
     * @return Response The HTTP response containing the receipt details or PDF
     */
    public function getDetails(string $id): Response
    {
        return $this->connector->send(new GetReceiptDetailsRequest($id));
    }

    /**
     * Return items from a receipt.
     *
     * Creates a return receipt for items from an existing receipt.
     *
     * Endpoint: POST /receipts/{id}/return
     *
     * @param  ReturnReceiptRequestDto  $dto  The request data including ID and receipt data
     * @return Response The HTTP response containing the created return receipt
     */
    public function returnReceipt(ReturnReceiptRequestDto $dto): Response
    {
        return $this->connector->send(new ReturnReceiptRequest($dto));
    }

    /**
     * Void a receipt.
     *
     * Voids an electronic receipt. Only receipts in `submitted` and `ready` status can be voided.
     *
     * Endpoint: DELETE /receipts/{id}
     *
     * @param  string  $id  The ID of the receipt to void
     * @return Response The HTTP response (204 on success, 404 if not found)
     */
    public function delete(string $id): Response
    {
        return $this->connector->send(new DeleteReceiptRequest($id));
    }
}
