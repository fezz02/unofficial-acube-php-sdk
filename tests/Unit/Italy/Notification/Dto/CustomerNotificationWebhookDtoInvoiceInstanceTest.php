<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Concerns\InvoiceMarking;
use Fezz\Acube\Sdk\Italy\Invoice\Dto\InvoiceDto;
use Fezz\Acube\Sdk\Italy\Notification\Dto\CustomerNotificationWebhookDto;
use Fezz\Acube\Sdk\Italy\Notification\Dto\NotificationDto;

test('can create customer notification webhook dto with InvoiceDto instance', function (): void {
    $notification = NotificationDto::from([
        'uuid' => 'notification-uuid-123',
        'invoice_uuid' => 'invoice-uuid-456',
        'type' => 'NS',
        'created_at' => '2024-01-01T00:00:00Z',
        'file_name' => null,
        'message' => null,
        'downloaded' => false,
        'downloaded_at' => null,
    ]);

    $invoice = InvoiceDto::from([
        'uuid' => 'invoice-uuid-456',
        'marking' => InvoiceMarking::SENT,
        'notice' => null,
    ]);

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
        'invoice' => $invoice, // Already an InvoiceDto instance
    ];

    $dto = CustomerNotificationWebhookDto::from($data);

    expect($dto)
        ->toBeInstanceOf(CustomerNotificationWebhookDto::class)
        ->and($dto->invoice)->toBeInstanceOf(InvoiceDto::class)
        ->and($dto->invoice->uuid)->toBe('invoice-uuid-456');
});
