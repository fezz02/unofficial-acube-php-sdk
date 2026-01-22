<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\User\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for updating a user profile.
 *
 * This DTO contains the data required to update a user profile with invoicing information.
 * All fields are optional and nullable. The ID is passed separately as a path parameter.
 *
 * @see https://docs.acubeapi.com/documentation/common/user/
 */
final readonly class UpdateUserProfileRequestDto extends Dto
{
    /**
     * Create a new update user profile request DTO.
     *
     * @param  string|null  $fullname  The user's full name (optional)
     * @param  string|null  $invoicing_vat_number  The VAT number for invoicing (optional)
     * @param  string|null  $invoicing_fiscal_id  The fiscal identifier for invoicing (optional)
     * @param  string|null  $invoicing_address  The invoicing address (optional)
     * @param  string|null  $invoicing_city  The invoicing city (optional)
     * @param  string|null  $invoicing_province  The invoicing province (optional)
     * @param  string|null  $invoicing_cap  The invoicing postal code (CAP) (optional)
     * @param  string|null  $invoicing_name  The invoicing name (optional)
     * @param  string|null  $invoicing_country  The invoicing country (optional)
     * @param  string|null  $invoicing_sdi_recipient_code  The SDI recipient code (optional)
     * @param  string|null  $invoicing_sdi_pec  The SDI PEC (Posta Elettronica Certificata) address (optional)
     */
    public function __construct(
        public ?string $fullname = null,
        public ?string $invoicing_vat_number = null,
        public ?string $invoicing_fiscal_id = null,
        public ?string $invoicing_address = null,
        public ?string $invoicing_city = null,
        public ?string $invoicing_province = null,
        public ?string $invoicing_cap = null,
        public ?string $invoicing_name = null,
        public ?string $invoicing_country = null,
        public ?string $invoicing_sdi_recipient_code = null,
        public ?string $invoicing_sdi_pec = null
    ) {}
}
