<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\User\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object representing a single user sub-account.
 *
 * This DTO represents a sub-account associated with a user account,
 * containing information such as email, fiscal ID, full name, and status.
 *
 * @see https://docs.acubeapi.com/documentation/common/user/
 */
final readonly class UserSubAccountDto extends Dto
{
    /**
     * Create a new user sub-account DTO.
     *
     * @param  string  $email  The sub-account email address
     * @param  string  $fiscal_id  The fiscal identifier (tax ID, VAT number, etc.)
     * @param  string|null  $fullname  The full name of the sub-account holder, or null if not provided
     * @param  bool  $enabled  Whether the sub-account is enabled
     * @param  string  $created_at  ISO 8601 timestamp when the sub-account was created
     * @param  string  $updated_at  ISO 8601 timestamp when the sub-account was last updated
     */
    public function __construct(
        public string $email,
        public string $fiscal_id,
        public ?string $fullname,
        public bool $enabled,
        public string $created_at,
        public string $updated_at,
    ) {}
}
