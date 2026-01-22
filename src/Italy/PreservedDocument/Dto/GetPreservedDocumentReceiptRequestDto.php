<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\PreservedDocument\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for getting a preserved document receipt.
 *
 * This DTO encapsulates the UUID path parameter for retrieving the XML receipt for a preserved document.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/preserved-documents/
 */
final readonly class GetPreservedDocumentReceiptRequestDto extends Dto
{
    /**
     * Create a new get preserved document receipt request DTO.
     *
     * @param  string  $uuid  The UUID of the preserved document
     */
    public function __construct(
        public string $uuid
    ) {}
}
