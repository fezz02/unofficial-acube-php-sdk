<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Verify\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for verifying a person.
 *
 * This DTO encapsulates the person data for creating a verification request.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/verify/
 */
final readonly class VerifyPersonRequestDto extends Dto
{
    /**
     * Create a new verify person request DTO.
     *
     * @param  array<string, mixed>  $person  The person data
     */
    public function __construct(
        public array $person
    ) {}
}
