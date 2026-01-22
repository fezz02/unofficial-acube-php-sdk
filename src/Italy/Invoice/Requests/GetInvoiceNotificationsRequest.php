<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Requests;

use Fezz\Acube\Sdk\Italy\Invoice\Dto\GetInvoiceNotificationsRequestDto;
use Fezz\Acube\Sdk\Italy\Notification\Dto\NotificationDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for getting invoice notifications.
 *
 * This request sends a GET request to retrieve the collection of notifications for an invoice.
 *
 * Endpoint: GET /invoices/{uuid}/notifications
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final class GetInvoiceNotificationsRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get invoice notifications request.
     *
     * @param  GetInvoiceNotificationsRequestDto  $data  The request data including UUID
     */
    public function __construct(
        public readonly GetInvoiceNotificationsRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/invoices/{$this->data->uuid}/notifications";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return array<int, NotificationDto> The response DTO containing the list of notifications
     */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<int, array<string, mixed>> $json */
        $json = $response->json();

        return array_map(
            NotificationDto::from(...),
            $json
        );
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
        ];
    }
}
