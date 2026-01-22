<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Simulate;

use Fezz\Acube\Sdk\BaseResource;
use Fezz\Acube\Sdk\Italy\Simulate\Dto\SupplierInvoiceSimulationDto;
use Fezz\Acube\Sdk\Italy\Simulate\Requests\SimulateCustomerNotificationRequest;
use Fezz\Acube\Sdk\Italy\Simulate\Requests\SimulateSupplierInvoiceRequest;
use Saloon\Http\Response;

/**
 * Simulation API resource for the A-Cube Italy API.
 *
 * Provides methods for simulating invoices, notifications, and legal storage events
 * for testing and development purposes.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/simulate/
 */
final class Api extends BaseResource
{
    /**
     * Simulate a supplier invoice.
     *
     * Simulates a supplier invoice using a DTO that can contain either JSON or XML data.
     * The DTO automatically determines the content type and formats the payload accordingly.
     *
     * Endpoint: POST /simulate/supplier-invoice
     *
     * @param  SupplierInvoiceSimulationDto  $dto  The simulation DTO containing invoice data
     * @return Response The HTTP response
     */
    public function supplierInvoice(SupplierInvoiceSimulationDto $dto): Response
    {
        return $this->connector->send(new SimulateSupplierInvoiceRequest($dto));
    }

    /**
     * Simulate a supplier invoice from JSON payload.
     *
     * Simulates a supplier invoice using a JSON array payload.
     *
     * Endpoint: POST /simulate/supplier-invoice
     *
     * @param  array<string, mixed>  $payload  The invoice data as a JSON array
     * @return Response The HTTP response
     */
    public function supplierInvoiceJson(array $payload): Response
    {
        $dto = SupplierInvoiceSimulationDto::fromJson($payload);

        return $this->connector->send(new SimulateSupplierInvoiceRequest($dto));
    }

    /**
     * Simulate a supplier invoice from XML string.
     *
     * Simulates a supplier invoice using an XML string.
     *
     * Endpoint: POST /simulate/supplier-invoice
     *
     * @param  string  $xml  The invoice data as an XML string
     * @return Response The HTTP response
     */
    public function supplierInvoiceXml(string $xml): Response
    {
        $dto = SupplierInvoiceSimulationDto::fromXml($xml);

        return $this->connector->send(new SimulateSupplierInvoiceRequest($dto));
    }

    /**
     * Simulate a customer notification.
     *
     * Simulates a customer notification from SDI without a custom XML body.
     * The notification will be delivered to the configured endpoints for the
     * event `customer-notification`.
     *
     * Endpoint: POST /simulate/customer-notification/{notificationType}/{invoiceUuid}
     *
     * @param  string  $notificationType  The notification type code (NS, RC, MC, NE, DT, AT, ...)
     * @param  string  $invoiceUuid  The UUID of an invoice created via POST /invoices
     * @return Response The HTTP response
     */
    public function customerNotification(string $notificationType, string $invoiceUuid): Response
    {
        return $this->connector->send(
            new SimulateCustomerNotificationRequest($notificationType, $invoiceUuid)
        );
    }

    /**
     * Simulate a customized NS customer notification with XML body.
     *
     * Allows sending a custom NS notification XML which will be forwarded to
     * the configured endpoints for the event `customer-notification`.
     *
     * Endpoint: POST /simulate/customer-notification/{notificationType}/{invoiceUuid}
     *
     * @param  string  $notificationType  The notification type code (e.g. NS, RC, MC, NE, DT, AT)
     * @param  string  $invoiceUuid  The UUID of an invoice created via POST /invoices
     * @param  string  $xml  The XML content of the NS notification
     * @return Response The HTTP response
     */
    public function customerNotificationXml(string $notificationType, string $invoiceUuid, string $xml): Response
    {
        return $this->connector->send(
            new SimulateCustomerNotificationRequest($notificationType, $invoiceUuid, $xml)
        );
    }
}
