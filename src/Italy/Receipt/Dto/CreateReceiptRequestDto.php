<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Receipt\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for creating a receipt.
 *
 * This DTO encapsulates the receipt data for creating a new electronic receipt.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/receipts/
 */
final readonly class CreateReceiptRequestDto extends Dto
{
    /**
     * Create a new create receipt request DTO.
     *
     * @param  array<string, mixed>  $receipt  The receipt data
     */
    public function __construct(
        public array $receipt
    ) {}
}
