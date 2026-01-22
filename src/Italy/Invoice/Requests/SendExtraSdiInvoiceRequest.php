<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Requests;

use Fezz\Acube\Sdk\Italy\Invoice\Dto\SendExtraSdiInvoiceRequestDto;
use Fezz\Acube\Sdk\Italy\Invoice\Dto\SendInvoiceResponseDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Request for sending an extra SDI invoice.
 *
 * This request sends a POST request to create a new extra SDI invoice.
 *
 * Endpoint: POST /invoices/extra-sdi
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final class SendExtraSdiInvoiceRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * Create a new send extra SDI invoice request.
     *
     * @param  SendExtraSdiInvoiceRequestDto  $data  The request data including invoice data
     */
    public function __construct(
        public readonly SendExtraSdiInvoiceRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return '/invoices/extra-sdi';
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return SendInvoiceResponseDto The response DTO containing the invoice UUID
     */
    public function createDtoFromResponse(Response $response): SendInvoiceResponseDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return SendInvoiceResponseDto::from($json);
    }

    /**
     * Get the default body for the request.
     *
     * @return array<string, mixed> The request body containing the invoice data
     */
    protected function defaultBody(): array
    {
        return $this->data->invoice;
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
