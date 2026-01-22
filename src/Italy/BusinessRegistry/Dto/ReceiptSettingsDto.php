<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object representing receipt settings.
 *
 * This DTO represents the receipt settings for a business registry configuration.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry-configuration/
 */
final readonly class ReceiptSettingsDto extends Dto
{
    /**
     * Create a new receipt settings DTO.
     *
     * @param  array<int, string>|null  $receipts_alert_recipients  The list of email recipients for communications related to AdE technical problems
     * @param  string|null  $phone_number  The mobile phone number used to reset AdE password (with +xx international prefix). Can be null if you use an appointee
     */
    public function __construct(
        public ?array $receipts_alert_recipients = null,
        public ?string $phone_number = null,
    ) {}
}
