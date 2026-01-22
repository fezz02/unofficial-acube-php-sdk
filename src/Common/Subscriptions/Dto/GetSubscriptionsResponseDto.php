<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Common\Subscriptions\Dto;

/**
 * DTO representing the response from getting subscriptions.
 * This is an array of SubscriptionDto objects.
 *
 * @see https://docs.acubeapi.com/documentation/common/subscriptions/
 */
final readonly class GetSubscriptionsResponseDto
{
    /**
     * @param  array<SubscriptionDto>  $subscriptions
     */
    public function __construct(
        public array $subscriptions
    ) {}

    /**
     * Create from API response array.
     * The API returns an array of subscription objects.
     *
     * @param  array<int, array<string, mixed>>|array<string, mixed>  $data
     */
    public static function from(array $data): self
    {
        // Handle empty array
        if ($data === []) {
            return new self([]);
        }

        // Ensure each item is an array before mapping
        $subscriptions = [];
        foreach ($data as $item) {
            if (! empty($item) && is_array($item)) {
                /** @var array<string, mixed> $item */
                $subscriptions[] = SubscriptionDto::from($item);
            }
        }

        return new self($subscriptions);
    }
}
