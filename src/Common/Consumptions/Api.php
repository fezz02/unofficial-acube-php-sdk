<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\Consumptions;

use Fezz\Acube\Sdk\BaseResource;
use Fezz\Acube\Sdk\Common\Consumptions\Dto\GetConsumptionsRequestDto;
use Fezz\Acube\Sdk\Common\Consumptions\Requests\GetConsumptionRequest;
use Fezz\Acube\Sdk\Common\Consumptions\Requests\GetConsumptionsRequest;
use Saloon\Http\Response;

/**
 * Consumptions API resource for the A-Cube Common API.
 *
 * Provides methods for managing consumptions.
 *
 * @see https://docs.acubeapi.com/documentation/common/consumptions/
 */
final class Api extends BaseResource
{
    /**
     * List consumptions.
     *
     * Retrieves a collection of consumptions with optional filtering by year and month.
     *
     * Endpoint: GET /consumptions
     *
     * @param  GetConsumptionsRequestDto  $dto  The request data including optional query parameters
     * @return Response The HTTP response containing the list of consumptions
     */
    public function list(GetConsumptionsRequestDto $dto): Response
    {
        return $this->connector->send(new GetConsumptionsRequest($dto));
    }

    /**
     * Get a consumption by UUID.
     *
     * Retrieves a specific consumption by its UUID.
     *
     * Endpoint: GET /consumptions/{uuid}
     *
     * @param  string  $uuid  The UUID of the consumption to retrieve
     * @return Response The HTTP response containing the consumption data
     */
    public function get(string $uuid): Response
    {
        return $this->connector->send(new GetConsumptionRequest($uuid));
    }
}
