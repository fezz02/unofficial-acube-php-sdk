<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests;

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\ReceiptSettingsDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\UpdateReceiptSettingsRequestDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Request for updating receipt settings.
 *
 * This request sends a PUT request to update receipt settings for a business registry configuration.
 *
 * Endpoint: PUT /business-registry-configurations/{id}/receipt-settings
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry-configuration/
 */
final class UpdateReceiptSettingsRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    /**
     * Create a new update receipt settings request.
     *
     * @param  string  $id  The fiscal identifier of the Business Registry Configuration
     * @param  UpdateReceiptSettingsRequestDto  $bodyData  The body data including receipt settings
     */
    public function __construct(
        public readonly string $id,
        public readonly UpdateReceiptSettingsRequestDto $bodyData
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/business-registry-configurations/{$this->id}/receipt-settings";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return ReceiptSettingsDto The response DTO containing the updated receipt settings
     */
    public function createDtoFromResponse(Response $response): ReceiptSettingsDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return ReceiptSettingsDto::from($json);
    }

    /**
     * Get the default body for the request.
     *
     * @return array<string, mixed> The request body containing the receipt settings
     */
    protected function defaultBody(): array
    {
        $body = [
            'phone_number' => $this->bodyData->phone_number,
        ];

        if ($this->bodyData->receipts_alert_recipients !== null) {
            $body['receipts_alert_recipients'] = $this->bodyData->receipts_alert_recipients;
        }

        return $body;
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
}
