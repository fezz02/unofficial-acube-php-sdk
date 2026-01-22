<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Contracts;

use Fezz\Acube\Sdk\Exceptions\Authentication\TokenNotFoundException;
use Saloon\Contracts\Authenticator;

interface ProvidesAccount
{
    /**
     * MUST return a valid Authenticator.
     *
     * @throws TokenNotFoundException If no valid token is available.
     */
    public function getAuthenticator(): Authenticator;
}
