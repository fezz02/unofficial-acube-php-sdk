<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for updating a Business Registry entry.
 *
 * This DTO contains the required and optional fields for updating an existing business registry entry.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry/
 */
final readonly class UpdateBusinessRegistryRequestDto extends Dto
{
    /**
     * Create a new update business registry request DTO.
     *
     * @param  string  $head_office_address_street  The head office street address (required)
     * @param  string  $head_office_address_zip_code  The head office ZIP code (required)
     * @param  string  $head_office_address_city  The head office city (required)
     * @param  string  $head_office_address_country  The head office country (ISO 3166-1 alpha-2) (required)
     * @param  string|null  $head_office_address_street_number  The head office street number
     * @param  string|null  $head_office_address_province  The head office province
     * @param  string|null  $office_address_street  The office street address
     * @param  string|null  $office_address_street_number  The office street number
     * @param  string|null  $office_address_zip_code  The office ZIP code
     * @param  string|null  $office_address_city  The office city
     * @param  string|null  $office_address_province  The office province
     * @param  string|null  $office_address_country  The office country (ISO 3166-1 alpha-2)
     * @param  string|null  $business_vat_number_country  The business VAT number country (ISO 3166-1 alpha-2)
     * @param  string|null  $business_vat_number_code  The business VAT number code
     * @param  string|null  $business_fiscal_code  The business fiscal code
     * @param  string|null  $business_name  The business name
     * @param  string|null  $name  The person's name
     * @param  string|null  $surname  The person's surname
     * @param  string|null  $title  The person's title
     * @param  string|null  $cod_eori  The EORI code
     * @param  string|null  $professional_register  The professional register
     * @param  string|null  $professional_register_province  The professional register province
     * @param  string|null  $professional_register_registration_number  The professional register registration number
     * @param  string|null  $professional_register_registration_date  The professional register registration date (ISO 8601:2004)
     * @param  string|null  $tax_regime  The tax regime
     * @param  string|null  $contact_phone  The contact phone number
     * @param  string|null  $contact_fax  The contact fax number
     * @param  string|null  $contact_email  The contact email address
     * @param  string|null  $rea_registration_office  The REA registration office (2 chars Italian province)
     * @param  string|null  $rea_registration_number  The REA registration number
     * @param  string|null  $rea_registration_share_capital  The REA registration share capital
     * @param  string|null  $rea_registration_sole_shareholder  The REA registration sole shareholder (SU or SM)
     * @param  string|null  $rea_registration_liquidation_status  The REA registration liquidation status (LS or LN)
     * @param  string|null  $reference_administration  The reference administration
     * @param  string|null  $fiscal_representative_vat_number_country  The fiscal representative VAT number country (ISO 3166-1 alpha-2)
     * @param  string|null  $fiscal_representative_vat_number_code  The fiscal representative VAT number code
     * @param  string|null  $fiscal_representative_fiscal_code  The fiscal representative fiscal code
     * @param  string|null  $fiscal_representative_denomination  The fiscal representative denomination
     * @param  string|null  $fiscal_representative_name  The fiscal representative name
     * @param  string|null  $fiscal_representative_surname  The fiscal representative surname
     * @param  string|null  $fiscal_representative_title  The fiscal representative title
     * @param  string|null  $fiscal_representative_cod_eori  The fiscal representative EORI code
     * @param  string|null  $recipient_code  The recipient code
     */
    public function __construct(
        public string $head_office_address_street,
        public string $head_office_address_zip_code,
        public string $head_office_address_city,
        public string $head_office_address_country,
        public ?string $head_office_address_street_number = null,
        public ?string $head_office_address_province = null,
        public ?string $office_address_street = null,
        public ?string $office_address_street_number = null,
        public ?string $office_address_zip_code = null,
        public ?string $office_address_city = null,
        public ?string $office_address_province = null,
        public ?string $office_address_country = null,
        public ?string $business_vat_number_country = null,
        public ?string $business_vat_number_code = null,
        public ?string $business_fiscal_code = null,
        public ?string $business_name = null,
        public ?string $name = null,
        public ?string $surname = null,
        public ?string $title = null,
        public ?string $cod_eori = null,
        public ?string $professional_register = null,
        public ?string $professional_register_province = null,
        public ?string $professional_register_registration_number = null,
        public ?string $professional_register_registration_date = null,
        public ?string $tax_regime = null,
        public ?string $contact_phone = null,
        public ?string $contact_fax = null,
        public ?string $contact_email = null,
        public ?string $rea_registration_office = null,
        public ?string $rea_registration_number = null,
        public ?string $rea_registration_share_capital = null,
        public ?string $rea_registration_sole_shareholder = null,
        public ?string $rea_registration_liquidation_status = null,
        public ?string $reference_administration = null,
        public ?string $fiscal_representative_vat_number_country = null,
        public ?string $fiscal_representative_vat_number_code = null,
        public ?string $fiscal_representative_fiscal_code = null,
        public ?string $fiscal_representative_denomination = null,
        public ?string $fiscal_representative_name = null,
        public ?string $fiscal_representative_surname = null,
        public ?string $fiscal_representative_title = null,
        public ?string $fiscal_representative_cod_eori = null,
        public ?string $recipient_code = null,
    ) {}
}
