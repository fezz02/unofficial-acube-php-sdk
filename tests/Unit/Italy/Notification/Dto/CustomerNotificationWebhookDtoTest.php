<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\Notification\Dto\CustomerNotificationWebhookDto;

test('can create customer notification webhook dto from array', function (): void {
    $data = [
        'notification' => [
            'uuid' => 'notification-uuid-123',
            'invoice_uuid' => 'invoice-uuid-456',
            'type' => 'NS',
            'created_at' => '2024-01-01T00:00:00Z',
            'file_name' => null,
            'message' => null,
            'downloaded' => false,
            'downloaded_at' => null,
        ],
        'invoice' => [
            'uuid' => 'invoice-uuid-456',
            'marking' => 'sent',
            'notice' => null,
            'additional_fields' => [],
        ],
    ];

    $dto = CustomerNotificationWebhookDto::from($data);

    expect($dto)
        ->toBeInstanceOf(CustomerNotificationWebhookDto::class)
        ->and($dto->notification)->toBeInstanceOf(Fezz\Acube\Sdk\Italy\Notification\Dto\NotificationDto::class)
        ->and($dto->notification->uuid)->toBe('notification-uuid-123');
});
