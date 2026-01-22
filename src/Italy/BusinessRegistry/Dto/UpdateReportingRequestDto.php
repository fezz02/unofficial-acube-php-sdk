<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for updating reporting parameters.
 *
 * This DTO contains the fiscal identifier and reporting data for updating reporting parameters.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry-configuration/
 */
final readonly class UpdateReportingRequestDto extends Dto
{
    /**
     * Create a new update reporting request DTO.
     *
     * @param  string|null  $id  The fiscal identifier of the Business Registry Configuration (optional when used with separate path parameter)
     * @param  array<string, mixed>  $rejected_invoices_alert_schedule  The rejected invoices alert schedule
     */
    public function __construct(
        public ?string $id = null,
        public array $rejected_invoices_alert_schedule = [],
    ) {}
}
