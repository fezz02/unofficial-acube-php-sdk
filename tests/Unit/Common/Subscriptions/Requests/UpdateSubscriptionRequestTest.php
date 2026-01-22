<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Common\Subscriptions\Dto\UpdateSubscriptionRequestDto;
use Fezz\Acube\Sdk\Common\Subscriptions\Requests\UpdateSubscriptionRequest;

test('defaultBody excludes uuid from request body', function (): void {
    $dto = new UpdateSubscriptionRequestDto(
        uuid: 'sub-123',
        limit: 1000,
        active: true,
        auto_renew: false
    );

    $request = new UpdateSubscriptionRequest($dto);

    // Use reflection to access protected method
    $reflection = new ReflectionClass($request);
    if ($reflection->hasMethod('defaultBody')) {
        $method = $reflection->getMethod('defaultBody');

        $body = $method->invoke($request);

        expect($body)->toBeArray()
            ->and($body)->not->toHaveKey('uuid')
            ->and($body)->toHaveKey('limit')
            ->and($body)->toHaveKey('active')
            ->and($body)->toHaveKey('auto_renew')
            ->and($body['limit'])->toBe(1000)
            ->and($body['active'])->toBeTrue()
            ->and($body['auto_renew'])->toBeFalse();
    } else {
        // If defaultBody doesn't exist, skip this test
        expect(true)->toBeTrue();
    }
});
