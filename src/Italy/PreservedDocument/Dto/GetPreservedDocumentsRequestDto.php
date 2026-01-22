<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\PreservedDocument\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for listing preserved documents.
 *
 * This DTO encapsulates query parameters for paginating preserved documents.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/preserved-documents/
 */
final readonly class GetPreservedDocumentsRequestDto extends Dto
{
    /**
     * Create a new get preserved documents request DTO.
     *
     * @param  array<string, mixed>  $query  Query parameters including page
     */
    public function __construct(
        public array $query = []
    ) {}
}
