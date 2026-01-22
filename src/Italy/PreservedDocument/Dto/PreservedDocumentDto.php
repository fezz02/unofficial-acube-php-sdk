<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\PreservedDocument\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object representing a preserved document.
 *
 * This DTO represents a document that has been preserved in legal storage.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/preserved-documents/
 */
final readonly class PreservedDocumentDto extends Dto
{
    /**
     * Create a new preserved document DTO.
     *
     * @param  array<string, mixed>  $data  The preserved document data
     */
    public function __construct(
        public array $data
    ) {}

    /**
     * Create a DTO instance from an array.
     *
     * @param  array<string, mixed>  $data  The response data
     * @return static The DTO instance
     */
    public static function from(array $data): static
    {
        return new self($data);
    }
}
