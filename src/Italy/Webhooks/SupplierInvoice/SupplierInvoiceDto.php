<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Webhooks\SupplierInvoice;

use Fezz\Acube\Sdk\Dto;
use Fezz\Acube\Sdk\Italy\Webhooks\SupplierInvoice\Payload\InvoicePayloadDto;

/**
 * Data Transfer Object representing an invoice in a supplier invoice webhook.
 *
 * This DTO represents the invoice object with metadata and payload.
 */
final readonly class SupplierInvoiceDto extends Dto
{
    /**
     * Create a new supplier invoice DTO.
     *
     * @param  string  $uuid  The invoice UUID
     * @param  string  $created_at  ISO 8601 timestamp when the invoice was created
     * @param  string  $filename  The invoice filename
     * @param  string  $file_id  The file ID
     * @param  InvoicePayloadDto  $payload  The invoice payload containing FatturaPA data
     */
    public function __construct(
        public string $uuid,
        public string $created_at,
        public string $filename,
        public string $file_id,
        public InvoicePayloadDto $payload,
    ) {}

    /**
     * Create a supplier invoice DTO from an array.
     *
     * @param  array<string, mixed>  $data  The invoice data
     */
    public static function from(array $data): static
    {
        $payloadData = $data['payload'] ?? [];
        if (is_array($payloadData)) {
            /** @var array<string, mixed> $payloadData */
            $payload = InvoicePayloadDto::from($payloadData);
        } else {
            $payload = InvoicePayloadDto::from([]);
        }

        return new self(
            uuid: is_string($data['uuid'] ?? null) ? $data['uuid'] : '',
            created_at: is_string($data['created_at'] ?? null) ? $data['created_at'] : '',
            filename: is_string($data['filename'] ?? null) ? $data['filename'] : '',
            file_id: is_string($data['file_id'] ?? null) ? $data['file_id'] : '',
            payload: $payload,
        );
    }
}
