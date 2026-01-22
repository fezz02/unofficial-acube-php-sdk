<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\PreSaleActions\Dto;

/**
 * DTO representing the response from getting pre-sale actions.
 * This is an array of PreSaleActionDto objects.
 *
 * @see https://docs.acubeapi.com/documentation/common/pre-sale-actions/
 */
final readonly class GetPreSaleActionsResponseDto
{
    /**
     * @param  array<PreSaleActionDto>  $preSaleActions
     */
    public function __construct(
        public array $preSaleActions
    ) {}

    /**
     * Create from API response array.
     * The API returns an array of pre-sale action objects.
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
        $preSaleActions = [];
        foreach ($data as $item) {
            if (! empty($item) && is_array($item)) {
                /** @var array<string, mixed> $item */
                $preSaleActions[] = PreSaleActionDto::from($item);
            }
        }

        return new self($preSaleActions);
    }
}
