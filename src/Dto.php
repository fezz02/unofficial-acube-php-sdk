<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk;

/**
 * Base class for all Data Transfer Objects (DTOs).
 *
 * DTOs are immutable objects that represent data structures returned by or
 * sent to the A-Cube API. They provide type safety and a clean interface
 * for working with API data.
 *
 * All DTOs extend this base class and inherit the `from()` method for
 * creating instances from arrays, and the `all()` method for converting
 * instances back to arrays.
 *
 * @see https://en.wikipedia.org/wiki/Data_transfer_object
 */
abstract readonly class Dto
{
    /**
     * Create a DTO instance from an array of data.
     *
     * The array keys should match the constructor parameter names.
     * This method uses named parameters to construct the DTO instance.
     *
     * @param  array<string, mixed>|array<int, mixed>  $data  The data array
     *
     * @phpstan-return static
     */
    public static function from(array $data): static
    {
        /** @phpstan-var static */
        // @phpstan-ignore-next-line
        return new static(...$data);
    }

    /**
     * Convert the DTO instance to an array.
     *
     * Returns all public properties of the DTO as an associative array.
     *
     * @return array<string, mixed> The DTO data as an array
     */
    public function all(): array
    {
        return get_object_vars($this);
    }
}
