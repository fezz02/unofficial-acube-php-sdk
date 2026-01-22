<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\PreservedDocument\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for getting a single preserved document by ID.
 *
 * This DTO encapsulates the path parameter used to retrieve a preserved document.
 */
final readonly class GetPreservedDocumentRequestDto extends Dto
{
    /**
     * Create a new get preserved document request DTO.
     *
     * @param  string  $id  The ID of the preserved document to retrieve
     */
    public function __construct(
        public string $id,
    ) {}
}
