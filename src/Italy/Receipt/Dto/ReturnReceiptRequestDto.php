<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Receipt\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for returning items from a receipt.
 *
 * This DTO encapsulates the ID and receipt data for returning items.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/receipts/
 */
final readonly class ReturnReceiptRequestDto extends Dto
{
    /**
     * Create a new return receipt request DTO.
     *
     * @param  string  $id  The ID of the receipt to return items from
     * @param  array<string, mixed>  $receipt  The return receipt data
     */
    public function __construct(
        public string $id,
        public array $receipt
    ) {}
}
