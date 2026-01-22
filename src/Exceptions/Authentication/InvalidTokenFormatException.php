<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Exceptions\Authentication;

use RuntimeException;

/**
 * Exception thrown when a token does not match the expected format.
 *
 * This may occur when parsing an access token returned from an external API
 * or loading it from a cache that contains invalid/unsupported data.
 */
final class InvalidTokenFormatException extends RuntimeException
{
    /**
     * Create a new InvalidTokenFormatException instance.
     *
     * @param  string  $message  Optional custom message to describe the specific formatting issue.
     */
    public function __construct(string $message = 'Invalid token format.')
    {
        parent::__construct($message);
    }
}
