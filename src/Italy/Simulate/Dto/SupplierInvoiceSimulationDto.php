<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Simulate\Dto;

use InvalidArgumentException;

/**
 * Data Transfer Object for supplier invoice simulation.
 *
 * This DTO encapsulates invoice data for simulation purposes and provides
 * methods to convert it to JSON or XML format based on the content type.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/simulate/
 */
final readonly class SupplierInvoiceSimulationDto
{
    /**
     * Create a new supplier invoice simulation DTO.
     *
     * @param  array<string, mixed>|string  $content  The invoice data (JSON array or XML string)
     * @param  string  $contentType  The content type ('application/json' or 'application/xml')
     */
    private function __construct(
        private array|string $content,
        private string $contentType
    ) {}

    /**
     * Create a DTO instance from a JSON array.
     *
     * @param  array<string, mixed>  $payload  The invoice data as a JSON array
     * @return self The DTO instance
     */
    public static function fromJson(array $payload): self
    {
        return new self($payload, 'application/json');
    }

    /**
     * Create a DTO instance from an XML string.
     *
     * @param  string  $xml  The invoice data as an XML string
     * @return self The DTO instance
     */
    public static function fromXml(string $xml): self
    {
        return new self($xml, 'application/xml');
    }

    /**
     * Convert the DTO content to a JSON array.
     *
     * @return array<string, mixed> The invoice data as a JSON array
     *
     * @throws InvalidArgumentException If the content is not JSON
     */
    public function toJson(): array
    {
        if (! is_array($this->content)) {
            throw new InvalidArgumentException('Cannot convert XML content to JSON. Use toXml() instead.');
        }

        return $this->content;
    }

    /**
     * Convert the DTO content to an XML string.
     *
     * @return string The invoice data as an XML string
     *
     * @throws InvalidArgumentException If the content is not XML
     */
    public function toXml(): string
    {
        if (! is_string($this->content)) {
            throw new InvalidArgumentException('Cannot convert JSON content to XML. Use toJson() instead.');
        }

        return $this->content;
    }

    /**
     * Get the content type for the DTO.
     *
     * @return string The content type ('application/json' or 'application/xml')
     */
    public function contentType(): string
    {
        return $this->contentType;
    }
}
