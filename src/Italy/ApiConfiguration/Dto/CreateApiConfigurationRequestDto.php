<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\ApiConfiguration\Dto;

use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object for creating an API configuration.
 *
 * Represents the request body for POST /api-configurations.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/
 */
final readonly class CreateApiConfigurationRequestDto extends Dto
{
    /**
     * Create a new create API configuration request DTO.
     *
     * @param  string  $event  The event type
     * @param  string  $target_url  The target URL for the webhook
     * @param  string  $authentication_type  The authentication type ("query" or "header")
     * @param  string|null  $authentication_key  The authentication key (if any)
     * @param  string|null  $authentication_token  The authentication token (if any)
     * @param  array<mixed>  $business_registry_configurations  The associated business registry configurations
     */
    public function __construct(
        public string $event,
        public string $target_url,
        public string $authentication_type,
        public ?string $authentication_key = null,
        public ?string $authentication_token = null,
        public array $business_registry_configurations = [],
    ) {}
}
