<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for removing a sub account.
 *
 * This DTO contains the email path parameter for removing a sub account from a business registry configuration.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry-configuration/
 */
final readonly class RemoveSubAccountRequestDto extends Dto
{
    /**
     * Create a new remove sub account request DTO.
     *
     * @param  string  $id  The fiscal identifier of the Business Registry
     * @param  string  $email  The email of the sub account to remove
     */
    public function __construct(
        public string $id,
        public string $email,
    ) {}
}
