<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Dto;

/**
 * DTO representing the response from getting invoices.
 * This is an array of InvoiceDto objects.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoices/
 */
final readonly class GetInvoicesResponseDto
{
    /**
     * @param  array<InvoiceDto>  $invoices
     */
    public function __construct(
        public array $invoices
    ) {}

    /**
     * Create from API response array.
     * The API returns an array of invoice objects.
     *
     * @param  array<int, array<string, mixed>>|array<string, mixed>  $data
     */
    public static function from(array $data): self
    {
        // Handle empty array
        if ($data === []) {
            return new self([]);
        }

        // Ensure each item is an array before mapping
        $invoices = [];
        foreach ($data as $item) {
            if (! empty($item) && is_array($item)) {
                /** @var array<string, mixed> $item */
                $invoices[] = InvoiceDto::from($item);
            }
        }

        return new self($invoices);
    }
}
