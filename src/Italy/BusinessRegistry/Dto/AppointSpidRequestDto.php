<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for appointing a 3rd party person to use receipt services via SPID.
 *
 * This DTO contains the fiscal identifier and data required to appoint a 3rd party person to use the receipt services
 * on the Agenzia delle Entrate portal with SPID credentials.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/business-registry-configuration/
 */
final readonly class AppointSpidRequestDto extends Dto
{
    /**
     * Create a new appoint SPID request DTO.
     *
     * @param  string  $id  The fiscal identifier of the Business Registry
     * @param  string  $appointee_fiscal_id  The appointee fiscal id. The special value A-CUBE tells that the A-Cube default fiscal id will be used
     * @param  string  $appointing_person_data_fiscal_code  The appointing person fiscal code
     * @param  string  $appointing_person_data_name  The appointing person name
     * @param  string  $appointing_person_data_surname  The appointing person surname
     * @param  string  $appointing_person_data_residence  The appointing person residence
     * @param  string  $appointing_person_data_otp_cell_phone  The appointing person cell phone number with international prefix for OTP signature (e.g. +3912345678)
     * @param  string  $appointing_person_data_email  The appointing person email
     * @param  string|null  $return_url  The return URL
     */
    public function __construct(
        public string $id,
        public string $appointee_fiscal_id,
        public string $appointing_person_data_fiscal_code,
        public string $appointing_person_data_name,
        public string $appointing_person_data_surname,
        public string $appointing_person_data_residence,
        public string $appointing_person_data_otp_cell_phone,
        public string $appointing_person_data_email,
        public ?string $return_url = null,
    ) {}
}
