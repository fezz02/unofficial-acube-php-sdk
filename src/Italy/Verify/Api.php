<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Verify;

use Fezz\Acube\Sdk\BaseResource;
use Fezz\Acube\Sdk\Italy\Verify\Dto\VerifyPersonRequestDto;
use Fezz\Acube\Sdk\Italy\Verify\Requests\VerifyCompanyRequest;
use Fezz\Acube\Sdk\Italy\Verify\Requests\VerifyCompanySimpleRequest;
use Fezz\Acube\Sdk\Italy\Verify\Requests\VerifyFiscalIdRequest;
use Fezz\Acube\Sdk\Italy\Verify\Requests\VerifyPersonRequest;
use Fezz\Acube\Sdk\Italy\Verify\Requests\VerifySplitRequest;
use Saloon\Http\Response;

/**
 * Verify API resource for the A-Cube Italy API.
 *
 * Provides methods for verifying companies, fiscal IDs, persons, and split payment status.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/verify/
 */
final class Api extends BaseResource
{
    /**
     * Verify company (simple).
     *
     * Retrieves basic information about a company by VAT number or fiscal id.
     *
     * Endpoint: GET /verify/company/simple/{id}
     *
     * @param  string  $id  VAT number WITHOUT the country prefix, or fiscal id
     * @return Response The HTTP response containing basic company information
     */
    public function companySimple(string $id): Response
    {
        return $this->connector->send(new VerifyCompanySimpleRequest($id));
    }

    /**
     * Verify company.
     *
     * Retrieves information about a company by VAT number or fiscal id.
     *
     * Endpoint: GET /verify/company/{id}
     *
     * @param  string  $id  VAT number WITHOUT the country prefix, or fiscal id
     * @return Response The HTTP response containing company information
     */
    public function company(string $id): Response
    {
        return $this->connector->send(new VerifyCompanyRequest($id));
    }

    /**
     * Verify fiscal ID.
     *
     * Verifies if a fiscal ID is valid.
     *
     * Endpoint: GET /verify/fiscal-id/{id}
     *
     * @param  string  $id  Fiscal id
     * @return Response The HTTP response containing fiscal ID validity
     */
    public function fiscalId(string $id): Response
    {
        return $this->connector->send(new VerifyFiscalIdRequest($id));
    }

    /**
     * Verify person.
     *
     * Creates a request to obtain information about a natural or legal person.
     * The response will be sent to your configured endpoints.
     *
     * Endpoint: POST /verify/person
     *
     * @param  VerifyPersonRequestDto  $dto  The request data including person data
     * @return Response The HTTP response (202 Accepted)
     */
    public function person(VerifyPersonRequestDto $dto): Response
    {
        return $this->connector->send(new VerifyPersonRequest($dto));
    }

    /**
     * Verify split payment.
     *
     * Checks if a company is subject to split-payment.
     *
     * Endpoint: GET /verify/split/{id}
     *
     * @param  string  $id  VAT number WITHOUT the country prefix, or fiscal id
     * @return Response The HTTP response containing split payment information
     */
    public function split(string $id): Response
    {
        return $this->connector->send(new VerifySplitRequest($id));
    }
}
