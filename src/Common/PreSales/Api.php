<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\PreSales;

use Fezz\Acube\Sdk\BaseResource;
use Fezz\Acube\Sdk\Common\PreSales\Dto\GetPreSalesRequestDto;
use Fezz\Acube\Sdk\Common\PreSales\Requests\GetPreSaleRequest;
use Fezz\Acube\Sdk\Common\PreSales\Requests\GetPreSalesRequest;
use Saloon\Http\Response;

/**
 * Pre-sales API resource for the A-Cube Common API.
 *
 * Provides methods for managing pre-sales.
 *
 * @see https://docs.acubeapi.com/documentation/common/pre-sales/
 */
final class Api extends BaseResource
{
    /**
     * List pre-sales.
     *
     * Retrieves a collection of pre-sales.
     *
     * Endpoint: GET /pre-sales
     *
     * @param  GetPreSalesRequestDto  $dto  The request data including optional query parameters
     * @return Response The HTTP response containing the list of pre-sales
     */
    public function list(GetPreSalesRequestDto $dto): Response
    {
        return $this->connector->send(new GetPreSalesRequest($dto));
    }

    /**
     * Get a pre-sale by UUID.
     *
     * Retrieves a specific pre-sale by its UUID.
     *
     * Endpoint: GET /pre-sales/{uuid}
     *
     * @param  string  $uuid  The pre-sale UUID
     * @return Response The HTTP response containing the pre-sale data
     */
    public function get(string $uuid): Response
    {
        return $this->connector->send(new GetPreSaleRequest($uuid));
    }
}
