<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for updating receipt settings.
 *
 * This DTO contains the fiscal identifier and receipt settings data for updating receipt settings.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry-configuration/
 */
final readonly class UpdateReceiptSettingsRequestDto extends Dto
{
    /**
     * Create a new update receipt settings request DTO.
     *
     * @param  string|null  $id  The fiscal identifier of the Business Registry Configuration (optional when used with separate path parameter)
     * @param  string  $phone_number  The mobile phone number used to reset AdE password (with +xx international prefix). Can be null if you use an appointee (required)
     * @param  array<int, string>|null  $receipts_alert_recipients  The list of email recipients for communications related to AdE technical problems
     */
    public function __construct(
        public ?string $id = null,
        public string $phone_number = '',
        public ?array $receipts_alert_recipients = null,
    ) {}
}
