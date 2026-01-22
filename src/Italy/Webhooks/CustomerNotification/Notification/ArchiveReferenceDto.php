<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Webhooks\CustomerNotification\Notification;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object representing an archive reference (riferimento_archivio).
 *
 * This DTO represents the archive reference information within a notification message,
 * containing the SDI identifier and file name of the archived file.
 */
final readonly class ArchiveReferenceDto extends Dto
{
    /**
     * Create a new archive reference DTO.
     *
     * @param  string  $identificativo_sdi  The SDI identifier
     * @param  string  $nome_file  The file name
     */
    public function __construct(
        public string $identificativo_sdi,
        public string $nome_file,
    ) {}
}
