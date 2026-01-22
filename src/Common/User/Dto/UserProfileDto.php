<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\User\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object representing a user profile with invoicing information.
 *
 * This DTO represents a user profile containing invoicing details such as
 * VAT number, fiscal ID, address, and SDI (Sistema di Interscambio) information.
 *
 * @see https://docs.acubeapi.com/documentation/common/user/
 */
final readonly class UserProfileDto extends Dto
{
    /**
     * Create a new user profile DTO.
     *
     * @param  string  $email  The user's email address
     * @param  string  $fullname  The user's full name
     * @param  string  $invoicing_vat_number  The VAT number for invoicing
     * @param  string  $invoicing_fiscal_id  The fiscal identifier for invoicing
     * @param  string  $invoicing_address  The invoicing address
     * @param  string  $invoicing_city  The invoicing city
     * @param  string  $invoicing_province  The invoicing province
     * @param  string  $invoicing_cap  The invoicing postal code (CAP)
     * @param  string  $invoicing_name  The invoicing name
     * @param  string  $invoicing_country  The invoicing country
     * @param  string  $invoicing_sdi_recipient_code  The SDI recipient code
     * @param  string  $invoicing_sdi_pec  The SDI PEC (Posta Elettronica Certificata) address
     */
    public function __construct(
        public string $email,
        public string $fullname,
        public string $invoicing_vat_number,
        public string $invoicing_fiscal_id,
        public string $invoicing_address,
        public string $invoicing_city,
        public string $invoicing_province,
        public string $invoicing_cap,
        public string $invoicing_name,
        public string $invoicing_country,
        public string $invoicing_sdi_recipient_code,
        public string $invoicing_sdi_pec,
    ) {}
}
