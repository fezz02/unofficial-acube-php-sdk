<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\InvoiceImport\Requests;

use Fezz\Acube\Sdk\Italy\InvoiceImport\Dto\InvoiceImportResponseDto;
use Fezz\Acube\Sdk\Italy\InvoiceImport\Dto\SupplierInvoiceImportRequestDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Request for importing a supplier invoice.
 *
 * This request sends a POST request to import a supplier invoice with
 * base64-encoded XML and optional metadata file.
 *
 * Endpoint: POST /supplier-invoice-imports
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoice-imports/
 */
final class SupplierInvoiceImportRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * Create a new supplier invoice import request.
     *
     * @param  SupplierInvoiceImportRequestDto  $data  The import data
     */
    public function __construct(
        public readonly SupplierInvoiceImportRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return '/supplier-invoice-imports';
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return InvoiceImportResponseDto The response DTO containing the invoice UUID
     */
    public function createDtoFromResponse(Response $response): InvoiceImportResponseDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return InvoiceImportResponseDto::from($json);
    }

    /**
     * Get the default headers for the request.
     *
     * @return array<string, string> The default headers
     */
    protected function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }

    /**
     * Get the default body for the request.
     *
     * @return array<string, mixed> The request body containing the import data
     */
    protected function defaultBody(): array
    {
        return $this->data->all();
    }
}
