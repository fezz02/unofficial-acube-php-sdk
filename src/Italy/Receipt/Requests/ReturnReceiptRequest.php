<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Receipt\Requests;

use Fezz\Acube\Sdk\Italy\Receipt\Dto\ReceiptDto;
use Fezz\Acube\Sdk\Italy\Receipt\Dto\ReturnReceiptRequestDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Request for returning items from a receipt.
 *
 * This request sends a POST request to return items from an electronic receipt.
 *
 * Endpoint: POST /receipts/{id}/return
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/receipts/
 */
final class ReturnReceiptRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * Create a new return receipt request.
     *
     * @param  ReturnReceiptRequestDto  $data  The request data including ID and receipt data
     */
    public function __construct(
        public readonly ReturnReceiptRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/receipts/{$this->data->id}/return";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return ReceiptDto The response DTO containing the created return receipt
     */
    public function createDtoFromResponse(Response $response): ReceiptDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return ReceiptDto::from($json);
    }

    /**
     * Get the default body for the request.
     *
     * @return array<string, mixed> The request body containing the receipt data
     */
    protected function defaultBody(): array
    {
        return $this->data->receipt;
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
