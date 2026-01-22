<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Simulate\Requests;

use Fezz\Acube\Sdk\Italy\Simulate\Dto\SupplierInvoiceSimulationDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasStringBody;

/**
 * Request for simulating a supplier invoice.
 *
 * This request sends a POST request to simulate a supplier invoice.
 * The request can accept either JSON or XML content based on the DTO content type.
 *
 * Endpoint: POST /simulate/supplier-invoice
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/simulate/
 */
final class SimulateSupplierInvoiceRequest extends Request implements HasBody
{
    use HasStringBody;

    protected Method $method = Method::POST;

    /**
     * Create a new simulate supplier invoice request.
     *
     * @param  SupplierInvoiceSimulationDto  $dto  The simulation DTO containing invoice data
     */
    public function __construct(
        public readonly SupplierInvoiceSimulationDto $dto
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return '/simulate/supplier-invoice';
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return array<string, mixed> The response data
     */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return $json;
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
            'Content-Type' => $this->dto->contentType(),
        ];
    }

    /**
     * Get the default body for the request.
     *
     * Converts the DTO content to a string format. For JSON, the array is JSON encoded.
     * For XML, the string is returned as-is.
     *
     * @return string The request body as a string
     */
    protected function defaultBody(): string
    {
        return $this->dto->contentType() === 'application/json'
            ? json_encode($this->dto->toJson(), JSON_THROW_ON_ERROR)
            : $this->dto->toXml();
    }
}
