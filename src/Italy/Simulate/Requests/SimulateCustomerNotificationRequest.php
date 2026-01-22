<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Simulate\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasStringBody;

/**
 * Request for simulating a customer notification.
 *
 * This request sends a POST request to simulate a customer notification from SDI.
 * It supports both the basic simulation (no body) and customized NS notification
 * with an XML body.
 *
 * Endpoint: POST /simulate/customer-notification/{notificationType}/{invoiceUuid}
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/simulate/
 */
final class SimulateCustomerNotificationRequest extends Request implements HasBody
{
    use HasStringBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $notificationType  The notification type code (e.g. NS, RC, MC, NE, DT, AT)
     * @param  string  $invoiceUuid  The UUID of an invoice created via POST /invoices
     * @param  string|null  $xmlBody  Optional XML body for customized NS notification
     */
    public function __construct(
        public readonly string $notificationType,
        public readonly string $invoiceUuid,
        public readonly ?string $xmlBody = null,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/simulate/customer-notification/{$this->notificationType}/{$this->invoiceUuid}";
    }

    /**
     * @return array<string, mixed>
     */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return $json;
    }

    /**
     * @return array<string, string>
     */
    protected function defaultHeaders(): array
    {
        $headers = [
            'Accept' => 'application/json',
        ];

        if ($this->xmlBody !== null) {
            $headers['Content-Type'] = 'application/xml';
        }

        return $headers;
    }

    protected function defaultBody(): string
    {
        return $this->xmlBody ?? '';
    }
}
