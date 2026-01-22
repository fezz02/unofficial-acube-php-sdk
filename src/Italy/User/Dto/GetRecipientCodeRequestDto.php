<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\User\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for getting a user's recipient code.
 *
 * This DTO encapsulates the user ID path parameter.
 */
final readonly class GetRecipientCodeRequestDto extends Dto
{
    /**
     * Create a new get recipient code request DTO.
     *
     * @param  string  $id  The user ID
     */
    public function __construct(
        public string $id,
    ) {}
}
