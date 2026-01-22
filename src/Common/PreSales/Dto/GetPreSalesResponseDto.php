<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\PreSales\Dto;

/**
 * DTO representing the response from getting pre-sales.
 * This is an array of PreSaleDto objects.
 *
 * @see https://docs.acubeapi.com/documentation/common/pre-sales/
 */
final readonly class GetPreSalesResponseDto
{
    /**
     * @param  array<PreSaleDto>  $preSales
     */
    public function __construct(
        public array $preSales
    ) {}

    /**
     * Create from API response array.
     * The API returns an array of pre-sale objects.
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
        $preSales = [];
        foreach ($data as $item) {
            if (! empty($item) && is_array($item)) {
                /** @var array<string, mixed> $item */
                $preSales[] = PreSaleDto::from($item);
            }
        }

        return new self($preSales);
    }
}
