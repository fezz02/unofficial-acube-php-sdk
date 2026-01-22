<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\InvoiceExtract;

use Fezz\Acube\Sdk\BaseResource;
use Fezz\Acube\Sdk\Italy\InvoiceExtract\Dto\CreateInvoiceExtractJobRequestDto;
use Fezz\Acube\Sdk\Italy\InvoiceExtract\Dto\GetInvoiceExtractJobRequestDto;
use Fezz\Acube\Sdk\Italy\InvoiceExtract\Dto\GetInvoiceExtractResultRequestDto;
use Fezz\Acube\Sdk\Italy\InvoiceExtract\Requests\CreateInvoiceExtractJobRequest;
use Fezz\Acube\Sdk\Italy\InvoiceExtract\Requests\GetInvoiceExtractJobRequest;
use Fezz\Acube\Sdk\Italy\InvoiceExtract\Requests\GetInvoiceExtractResultRequest;
use Saloon\Http\Response;

/**
 * Invoice extract API resource for the A-Cube Italy API.
 *
 * Provides methods for extracting invoice information from PDF files and
 * converting them to FatturaPA XML/JSON format using AI.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoice-extract/
 */
final class Api extends BaseResource
{
    /**
     * Create an invoice extract job.
     *
     * Uploads a PDF invoice and starts the extraction process.
     *
     * Endpoint: POST /invoice-extract
     *
     * @param  CreateInvoiceExtractJobRequestDto  $dto  The request data including file path and optional conversion configuration
     * @return Response The HTTP response containing the job information
     */
    public function createJob(CreateInvoiceExtractJobRequestDto $dto): Response
    {
        return $this->connector->send(new CreateInvoiceExtractJobRequest($dto));
    }

    /**
     * Get an invoice extract job by UUID.
     *
     * Retrieves the status of an invoice extraction job.
     *
     * Endpoint: GET /invoice-extract/{uuid}
     *
     * @param  GetInvoiceExtractJobRequestDto  $dto  The request data including UUID
     * @return Response The HTTP response containing the job information
     */
    public function getJob(GetInvoiceExtractJobRequestDto $dto): Response
    {
        return $this->connector->send(new GetInvoiceExtractJobRequest($dto));
    }

    /**
     * Get the result of an invoice extract job.
     *
     * Retrieves the extracted invoice in XML or JSON format.
     *
     * Endpoint: GET /invoice-extract/{uuid}/result
     *
     * @param  GetInvoiceExtractResultRequestDto  $dto  The request data including UUID and format
     * @return Response The HTTP response containing the extracted invoice
     */
    public function getResult(GetInvoiceExtractResultRequestDto $dto): Response
    {
        return $this->connector->send(new GetInvoiceExtractResultRequest($dto));
    }

    /**
     * Get the raw extracted information.
     *
     * Retrieves the information extracted from the PDF in a raw JSON format.
     *
     * Endpoint: GET /invoice-extract/{uuid}/raw
     *
     * @param  Dto\GetInvoiceExtractRawRequestDto  $dto  The request data including UUID
     * @return Response The HTTP response containing the raw extracted information
     */
    public function getRaw(Dto\GetInvoiceExtractRawRequestDto $dto): Response
    {
        return $this->connector->send(new Requests\GetInvoiceExtractRawRequest($dto));
    }
}
