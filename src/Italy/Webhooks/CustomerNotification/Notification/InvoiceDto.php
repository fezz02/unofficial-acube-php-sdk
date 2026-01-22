<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Webhooks\CustomerNotification\Notification;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object representing an invoice in a customer notification webhook.
 *
 * This DTO represents the complete FatturaPA invoice structure as received in webhook payloads.
 */
final readonly class InvoiceDto extends Dto
{
    /**
     * Create a new invoice DTO.
     *
     * @param  array<string, mixed>  $fattura_elettronica_header  The invoice header
     * @param  array<string, mixed>  $fattura_elettronica_body  The invoice body (object with numeric keys)
     */
    public function __construct(
        public array $fattura_elettronica_header,
        public array $fattura_elettronica_body,
    ) {}

    /**
     * Create an invoice DTO from an array.
     *
     * @param  array<string, mixed>  $data  The invoice data
     */
    public static function from(array $data): static
    {
        $header = $data['fattura_elettronica_header'] ?? [];
        $body = $data['fattura_elettronica_body'] ?? [];

        $headerArray = is_array($header) ? $header : [];
        $bodyArray = is_array($body) ? $body : [];

        /** @var array<string, mixed> $headerArray */
        /** @var array<string, mixed> $bodyArray */

        return new self(
            fattura_elettronica_header: $headerArray,
            fattura_elettronica_body: $bodyArray,
        );
    }
}
