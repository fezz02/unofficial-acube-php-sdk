<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\PreservedDocument;

use Fezz\Acube\Sdk\BaseResource;
use Fezz\Acube\Sdk\Italy\PreservedDocument\Dto\GetPreservedDocumentReceiptRequestDto;
use Fezz\Acube\Sdk\Italy\PreservedDocument\Dto\GetPreservedDocumentsRequestDto;
use Fezz\Acube\Sdk\Italy\PreservedDocument\Requests\GetPreservedDocumentReceiptRequest;
use Fezz\Acube\Sdk\Italy\PreservedDocument\Requests\GetPreservedDocumentRequest;
use Fezz\Acube\Sdk\Italy\PreservedDocument\Requests\GetPreservedDocumentsRequest;
use Saloon\Http\Response;

/**
 * Preserved documents API resource for the A-Cube Italy API.
 *
 * Provides methods for managing preserved documents in legal storage.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/preserved-documents/
 */
final class Api extends BaseResource
{
    /**
     * List preserved documents.
     *
     * Retrieves a collection of preserved documents with optional pagination.
     *
     * Endpoint: GET /preserved-documents
     *
     * @param  GetPreservedDocumentsRequestDto  $dto  The request data including optional query parameters
     * @return Response The HTTP response containing the list of preserved documents
     */
    public function list(GetPreservedDocumentsRequestDto $dto): Response
    {
        return $this->connector->send(new GetPreservedDocumentsRequest($dto));
    }

    /**
     * Get a preserved document by ID.
     *
     * Retrieves a specific preserved document by its ID.
     *
     * Endpoint: GET /preserved-documents/{id}
     *
     * @param  Dto\GetPreservedDocumentRequestDto  $dto  The request data including preserved document ID
     * @return Response The HTTP response containing the preserved document data
     */
    public function get(Dto\GetPreservedDocumentRequestDto $dto): Response
    {
        return $this->connector->send(new GetPreservedDocumentRequest($dto));
    }

    /**
     * Get a preserved document receipt.
     *
     * Retrieves the XML receipt for a preserved document.
     *
     * Endpoint: GET /preserved-documents/{uuid}/receipt
     *
     * @param  GetPreservedDocumentReceiptRequestDto  $dto  The request data including UUID
     * @return Response The HTTP response containing the XML receipt
     */
    public function getReceipt(GetPreservedDocumentReceiptRequestDto $dto): Response
    {
        return $this->connector->send(new GetPreservedDocumentReceiptRequest($dto));
    }
}
