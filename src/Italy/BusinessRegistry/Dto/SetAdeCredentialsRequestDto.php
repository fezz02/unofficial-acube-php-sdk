<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for setting Agenzia delle Entrate credentials.
 *
 * This DTO contains the fiscal identifier and credentials required to access the Agenzia delle Entrate portal (FiscOnline / Entratel).
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry-configuration/
 */
final readonly class SetAdeCredentialsRequestDto extends Dto
{
    /**
     * Create a new set ADE credentials request DTO.
     *
     * @param  string  $id  The fiscal identifier of the Business Registry
     * @param  string  $codice_fiscale  The fiscal code
     * @param  string  $password  The password
     * @param  string  $pin  The PIN
     */
    public function __construct(
        public string $id,
        public string $codice_fiscale,
        public string $password,
        public string $pin,
    ) {}
}
