<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Receipt\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object representing an electronic receipt.
 *
 * This DTO represents an electronic receipt (ricevuta fiscale elettronica).
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/receipts/
 */
final readonly class ReceiptDto extends Dto
{
    /**
     * Create a new receipt DTO.
     *
     * @param  array<string, mixed>  $data  The receipt data
     */
    public function __construct(
        public array $data
    ) {}

    /**
     * Create a DTO instance from an array.
     *
     * @param  array<string, mixed>  $data  The response data
     * @return static The DTO instance
     */
    public static function from(array $data): static
    {
        return new self($data);
    }
}
