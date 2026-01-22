<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\CassettoFiscale\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object representing a scheduled invoice download configuration.
 *
 * This DTO represents the configuration for scheduled daily downloads of invoices
 * from the "Cassetto Fiscale" (Italian tax authority's digital mailbox).
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/cassetto-fiscale/
 */
final readonly class ScheduledInvoiceDownloadDto extends Dto
{
    /**
     * Create a new scheduled invoice download DTO.
     *
     * @param  bool  $enabled  Whether the scheduled download is enabled
     * @param  string|null  $valid_until  ISO 8601 timestamp until when the schedule is valid
     * @param  bool|null  $auto_renew  Whether the schedule should auto-renew
     */
    public function __construct(
        public bool $enabled,
        public ?string $valid_until,
        public ?bool $auto_renew
    ) {}
}
