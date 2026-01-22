<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Dto;

use Fezz\Acube\Sdk\Concerns\InvoiceMarking;
use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object representing an invoice.
 *
 * This DTO represents an invoice with its key properties including UUID,
 * marking (status), notice, and other relevant fields.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final readonly class InvoiceDto extends Dto
{
    /**
     * Create a new invoice DTO.
     *
     * @param  string  $uuid  The unique identifier for the invoice
     * @param  InvoiceMarking  $marking  The current marking (status) of the invoice
     * @param  string|null  $notice  Optional notice or error message
     * @param  array<string, mixed>  $additionalFields  Additional invoice fields (e.g., filename, created_at, etc.)
     */
    public function __construct(
        public string $uuid,
        public InvoiceMarking $marking,
        public ?string $notice = null,
        public array $additionalFields = []
    ) {}

    /**
     * Create an invoice DTO from an array.
     * Handles the marking conversion from string to enum.
     *
     * @param  array<string, mixed>  $data  The invoice data
     */
    public static function from(array $data): static
    {
        /** @var InvoiceMarking $marking */
        $marking = is_string($data['marking'] ?? null)
            ? InvoiceMarking::from($data['marking'])
            : (($data['marking'] instanceof InvoiceMarking) ? $data['marking'] : InvoiceMarking::WAITING);

        /** @var string $uuid */
        $uuid = $data['uuid'] ?? '';
        /** @var string|null $notice */
        $notice = $data['notice'] ?? null;

        // Extract additional fields
        $additionalFields = $data;
        unset($additionalFields['uuid'], $additionalFields['marking'], $additionalFields['notice']);

        return new self(
            uuid: $uuid,
            marking: $marking,
            notice: $notice,
            additionalFields: $additionalFields
        );
    }
}
