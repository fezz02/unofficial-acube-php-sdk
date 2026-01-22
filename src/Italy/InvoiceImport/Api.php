<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\InvoiceImport;

use Fezz\Acube\Sdk\BaseResource;
use Fezz\Acube\Sdk\Italy\InvoiceImport\Dto\CustomerInvoiceImportRequestDto;
use Fezz\Acube\Sdk\Italy\InvoiceImport\Dto\SupplierInvoiceImportRequestDto;
use Fezz\Acube\Sdk\Italy\InvoiceImport\Requests\CustomerInvoiceImportRequest;
use Fezz\Acube\Sdk\Italy\InvoiceImport\Requests\SupplierInvoiceImportRequest;
use Saloon\Http\Response;

/**
 * Invoice imports API resource for the A-Cube Italy API.
 *
 * Provides methods for importing customer and supplier invoices from base64-encoded XML.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoice-imports/
 */
final class Api extends BaseResource
{
    /**
     * Import a customer invoice.
     *
     * Imports a customer invoice with base64-encoded XML and optional notification files.
     *
     * Endpoint: POST /customer-invoice-imports
     *
     * @param  CustomerInvoiceImportRequestDto  $dto  The import data
     * @return Response The HTTP response containing the imported invoice UUID
     */
    public function importCustomer(CustomerInvoiceImportRequestDto $dto): Response
    {
        return $this->connector->send(new CustomerInvoiceImportRequest($dto));
    }

    /**
     * Import a supplier invoice.
     *
     * Imports a supplier invoice with base64-encoded XML and optional metadata file.
     *
     * Endpoint: POST /supplier-invoice-imports
     *
     * @param  SupplierInvoiceImportRequestDto  $dto  The import data
     * @return Response The HTTP response containing the imported invoice UUID
     */
    public function importSupplier(SupplierInvoiceImportRequestDto $dto): Response
    {
        return $this->connector->send(new SupplierInvoiceImportRequest($dto));
    }
}
