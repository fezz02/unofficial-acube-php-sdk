<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Concerns\NotificationType;
use Fezz\Acube\Sdk\Italy\Notification\Dto\NotificationDto;

test('can create notification dto with non-string type', function (): void {
    $data = [
        'uuid' => 'notification-uuid-123',
        'invoice_uuid' => 'invoice-uuid-456',
        'type' => null, // Not a string, should default to NOTIFICA_SCARTO
        'created_at' => '2024-01-01T00:00:00Z',
        'file_name' => null,
        'message' => null,
        'downloaded' => false,
        'downloaded_at' => null,
    ];

    $dto = NotificationDto::from($data);

    expect($dto)
        ->toBeInstanceOf(NotificationDto::class)
        ->and($dto->uuid)->toBe('notification-uuid-123')
        ->and($dto->type)->toBe(NotificationType::NOTIFICA_SCARTO);
});
