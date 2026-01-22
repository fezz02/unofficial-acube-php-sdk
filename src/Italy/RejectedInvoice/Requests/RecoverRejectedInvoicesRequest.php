<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\RejectedInvoice\Requests;

use Fezz\Acube\Sdk\Italy\RejectedInvoice\Dto\RecoverRejectedInvoicesRequestDto;
use Fezz\Acube\Sdk\Italy\RejectedInvoice\Dto\RecoverRejectedInvoicesResponseDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Request for recovering rejected invoices.
 *
 * This request sends a POST request to start the recovery process for rejected invoices
 * within a date range.
 *
 * Endpoint: POST /rejected-invoices/{fiscalId}/recover
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/rejected-invoices/
 */
final class RecoverRejectedInvoicesRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * Create a new recover rejected invoices request.
     *
     * @param  string  $fiscalId  The fiscal ID
     * @param  RecoverRejectedInvoicesRequestDto  $payload  The recovery request payload (excluding fiscal_id)
     */
    public function __construct(
        public readonly string $fiscalId,
        public readonly RecoverRejectedInvoicesRequestDto $payload,
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/rejected-invoices/{$this->fiscalId}/recover";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return RecoverRejectedInvoicesResponseDto The response DTO containing the job UUID and count
     */
    public function createDtoFromResponse(Response $response): RecoverRejectedInvoicesResponseDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return RecoverRejectedInvoicesResponseDto::from($json);
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
     * @return array<string, mixed> The request body containing the date range
     */
    protected function defaultBody(): array
    {
        return $this->payload->all();
    }
}
