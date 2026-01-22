<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object representing reporting parameters.
 *
 * This DTO represents the reporting parameters for a business registry configuration.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry-configuration/
 */
final readonly class ReportingDto extends Dto
{
    /**
     * Create a new reporting DTO.
     *
     * @param  array<string, mixed>  $rejected_invoices_alert_schedule  The rejected invoices alert schedule (required)
     */
    public function __construct(
        public array $rejected_invoices_alert_schedule,
    ) {}
}
