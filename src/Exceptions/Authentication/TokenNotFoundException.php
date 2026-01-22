<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Exceptions\Authentication;

use RuntimeException;

/**
 * Exception thrown when attempting to access a missing or expired token
 * from a TokenCache implementation.
 */
final class TokenNotFoundException extends RuntimeException
{
    /**
     * Create a new TokenNotFoundException instance.
     *
     * @param  string  $message  Optional custom message for this exception.
     */
    public function __construct(string $message = 'Token not found in cache.')
    {
        parent::__construct($message);
    }
}
