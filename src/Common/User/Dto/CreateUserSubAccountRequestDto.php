<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\User\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for creating a user sub-account.
 *
 * This DTO contains the data required to create a new sub-account,
 * including email, password, fiscal ID, and optional fields.
 *
 * @see https://docs.acubeapi.com/documentation/common/user/#create-user-sub-account
 */
final readonly class CreateUserSubAccountRequestDto extends Dto
{
    /**
     * Create a new create sub-account request DTO.
     *
     * @param  string  $email  The email address for the new sub-account (must be a valid email format)
     * @param  string  $password  The password for the new sub-account (must meet A-Cube's password requirements)
     * @param  string  $fiscal_id  The fiscal identifier (tax ID, VAT number, etc.)
     * @param  string|null  $fullname  The full name of the sub-account holder (optional)
     * @param  bool|null  $enabled  Whether the sub-account should be enabled (optional, defaults to true)
     */
    public function __construct(
        public string $email,
        public string $password,
        public string $fiscal_id,
        public ?string $fullname,
        public ?bool $enabled
    ) {}
}
