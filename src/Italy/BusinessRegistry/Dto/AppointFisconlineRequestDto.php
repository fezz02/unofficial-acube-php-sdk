<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for appointing A-Cube to use receipt services via FiscOnline/Entratel.
 *
 * This DTO contains the fiscal identifier and credentials required to appoint A-Cube to use the receipt services
 * on the Agenzia delle Entrate portal using FiscOnline / Entratel credentials.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry-configuration/
 */
final readonly class AppointFisconlineRequestDto extends Dto
{
    /**
     * Create a new appoint FiscOnline request DTO.
     *
     * @param  string  $id  The fiscal identifier of the Business Registry
     * @param  string  $appointee_fiscal_id  The appointee fiscal id. The special value A-CUBE tells that the A-Cube default fiscal id will be used
     * @param  string  $codice_fiscale  The fiscal code
     * @param  string  $password  The password
     * @param  string  $pin  The PIN
     */
    public function __construct(
        public string $id,
        public string $appointee_fiscal_id,
        public string $codice_fiscale,
        public string $password,
        public string $pin,
    ) {}
}
