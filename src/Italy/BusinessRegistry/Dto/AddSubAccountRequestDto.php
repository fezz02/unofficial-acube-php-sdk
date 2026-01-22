<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for adding a sub account.
 *
 * This DTO contains the fiscal identifier and sub account data for adding a new sub account.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry-configuration/
 */
final readonly class AddSubAccountRequestDto extends Dto
{
    /**
     * Create a new add sub account request DTO.
     *
     * @param  string  $id  The fiscal identifier of the Business Registry
     * @param  string  $email  Email of the sub account (required)
     * @param  string|null  $password  Password of the sub account. If not provided, a random temporary password will be generated and a reset password link will be sent to the email address
     */
    public function __construct(
        public string $id,
        public string $email,
        public ?string $password = null,
    ) {}
}
