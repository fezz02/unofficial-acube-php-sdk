<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\Consumptions\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for the list consumptions response.
 *
 * This DTO represents the response from the GET /consumptions endpoint,
 * which returns an array of consumption objects.
 *
 * @see https://docs.acubeapi.com/documentation/common/consumptions/
 */
final readonly class GetConsumptionsResponseDto extends Dto
{
    /**
     * Create a new get consumptions response DTO.
     *
     * @param  array<int, ConsumptionDto>  $items  The list of consumptions
     */
    public function __construct(
        public array $items
    ) {}

    /**
     * Create a DTO instance from an array.
     *
     * @param  array<int, array<string, mixed>>  $data  The response data
     * @return static The DTO instance
     */
    public static function from(array $data): static
    {
        if ($data === []) {
            return new self([]);
        }

        $items = array_map(
            ConsumptionDto::from(...),
            $data
        );

        return new self($items);
    }
}
