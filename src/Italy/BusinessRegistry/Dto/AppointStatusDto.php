<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object representing the status of an appointing request.
 *
 * This DTO represents the status of an appointing request for a business registry configuration.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry-configuration/
 */
final readonly class AppointStatusDto extends Dto
{
    /**
     * Create a new appoint status DTO.
     *
     * @param  bool|null  $receipt_enabled  Whether receipt is enabled
     * @param  string|null  $appointee  The fiscal ID of the appointee
     * @param  string|null  $status  The status of the registration
     * @param  string|null  $url  The url to be used for recovering an ongoing appointing procedure or to get the signed contract for a completed processes
     */
    public function __construct(
        public ?bool $receipt_enabled = null,
        public ?string $appointee = null,
        public ?string $status = null,
        public ?string $url = null,
    ) {}
}
