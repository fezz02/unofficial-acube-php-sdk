<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common;

use Fezz\Acube\Sdk\AcubeApi;

/**
 * Connector for the A-Cube Common Management API.
 *
 * The Common API provides endpoints for authentication, user management,
 * and other common operations that are available across A-Cube services.
 *
 * Base URLs:
 * - Production: https://common.api.acubeapi.com
 * - Sandbox: https://common-sandbox.api.acubeapi.com
 *
 * @see https://docs.acubeapi.com/documentation/common/
 */
final class CommonConnector extends AcubeApi
{
    /**
     * Get the authentication API resource.
     *
     * Provides methods for logging in and managing authentication tokens.
     *
     * @return Authentication\Api The authentication API resource
     *
     * @see https://docs.acubeapi.com/documentation/common/authentication/
     */
    public function authentication(): Authentication\Api
    {
        return new Authentication\Api($this);
    }

    /**
     * Get the user management API resource.
     *
     * Provides methods for managing user accounts, sub-accounts, and user profiles.
     *
     * @return User\Api The user management API resource
     *
     * @see https://docs.acubeapi.com/documentation/common/user/
     */
    public function user(): User\Api
    {
        return new User\Api($this);
    }

    /**
     * Get the subscriptions API resource.
     *
     * Provides methods for managing subscriptions.
     *
     * @return Subscriptions\Api The subscriptions API resource
     *
     * @see https://docs.acubeapi.com/documentation/common/subscriptions/
     */
    public function subscriptions(): Subscriptions\Api
    {
        return new Subscriptions\Api($this);
    }

    /**
     * Get the pre-sales API resource.
     *
     * Provides methods for managing pre-sales.
     *
     * @return PreSales\Api The pre-sales API resource
     *
     * @see https://docs.acubeapi.com/documentation/common/pre-sales/
     */
    public function preSales(): PreSales\Api
    {
        return new PreSales\Api($this);
    }

    /**
     * Get the pre-sale actions API resource.
     *
     * Provides methods for managing pre-sale actions.
     *
     * @return PreSaleActions\Api The pre-sale actions API resource
     *
     * @see https://docs.acubeapi.com/documentation/common/pre-sale-actions/
     */
    public function preSaleActions(): PreSaleActions\Api
    {
        return new PreSaleActions\Api($this);
    }

    /**
     * Get the consumptions API resource.
     *
     * Provides methods for managing consumptions.
     *
     * @return Consumptions\Api The consumptions API resource
     *
     * @see https://docs.acubeapi.com/documentation/common/consumptions/
     */
    public function consumptions(): Consumptions\Api
    {
        return new Consumptions\Api($this);
    }
}
