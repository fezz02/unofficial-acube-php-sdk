<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\InvoiceExtract\Requests;

use Fezz\Acube\Sdk\Italy\InvoiceExtract\Dto\CreateInvoiceExtractJobRequestDto;
use Fezz\Acube\Sdk\Italy\InvoiceExtract\Dto\InvoiceExtractJobDto;
use RuntimeException;
use Saloon\Contracts\Body\HasBody;
use Saloon\Data\MultipartValue;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasMultipartBody;

/**
 * Request for creating an invoice extract job.
 *
 * This request sends a POST request with multipart form data to upload a PDF
 * invoice and start the extraction process.
 *
 * Endpoint: POST /invoice-extract
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoice-extract/
 */
final class CreateInvoiceExtractJobRequest extends Request implements HasBody
{
    use HasMultipartBody;

    protected Method $method = Method::POST;

    /**
     * Create a new create invoice extract job request.
     *
     * @param  CreateInvoiceExtractJobRequestDto  $data  The request data including file path and optional conversion configuration
     */
    public function __construct(
        public readonly CreateInvoiceExtractJobRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return '/invoice-extract';
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return InvoiceExtractJobDto The response DTO containing the job information
     */
    public function createDtoFromResponse(Response $response): InvoiceExtractJobDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return InvoiceExtractJobDto::from($json);
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

    /**
     * Get the default body for the request.
     *
     * @return array<MultipartValue> The multipart form data
     */
    protected function defaultBody(): array
    {
        $body = [];

        // Add file upload
        if (file_exists($this->data->file_path)) {
            $fileContents = @file_get_contents($this->data->file_path);
            if ($fileContents === false) {
                throw new RuntimeException("Failed to read file: {$this->data->file_path}");
            }
            $filename = basename($this->data->file_path);
            $body[] = new MultipartValue('file', $fileContents, $filename);
        } else {
            // If file doesn't exist, use the path as-is (for testing)
            $body[] = new MultipartValue('file', $this->data->file_path);
        }

        // Add conversion configuration if provided
        $configArray = [];
        if ($this->data->default_vat_rate !== null) {
            $configArray['default_vat_rate'] = $this->data->default_vat_rate;
        }
        if ($this->data->convert_amounts !== null) {
            $configArray['convert_amounts'] = $this->data->convert_amounts;
        }
        if ($configArray !== []) {
            $body[] = new MultipartValue(
                'conversion_configuration',
                json_encode($configArray, JSON_THROW_ON_ERROR)
            );
        }

        return $body;
    }
}
