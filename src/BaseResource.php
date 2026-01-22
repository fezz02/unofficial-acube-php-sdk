<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk;

use Saloon\Http\Connector;

/**
 * Base class for all API resource classes.
 *
 * Resource classes provide a convenient way to group related API endpoints
 * and provide a fluent interface for making API calls. Each resource has
 * access to the connector instance for sending requests.
 */
abstract class BaseResource
{
    /**
     * Create a new resource instance.
     *
     * @param  Connector  $connector  The connector instance to use for API requests
     */
    public function __construct(
        protected Connector $connector,
    ) {}
}
