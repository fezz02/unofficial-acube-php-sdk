<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Contracts;

/**
 * Interface for enums that provide labels.
 *
 * Enums implementing this interface must provide a label() method
 * that returns the label for each enum case.
 */
interface Labellable
{
    /**
     * Get the label for this enum case.
     *
     * @return string The label
     */
    public function label(): string;
}
