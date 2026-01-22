<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object representing a sub account.
 *
 * This DTO represents a sub account connected to a business registry configuration.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry-configuration/
 */
final readonly class SubAccountDto extends Dto
{
    /**
     * Create a new sub account DTO.
     *
     * @param  string  $email  The email of the sub account
     */
    public function __construct(
        public string $email,
    ) {}
}
