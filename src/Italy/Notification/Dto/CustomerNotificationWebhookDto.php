<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Notification\Dto;

use Fezz\Acube\Sdk\Dto;
use Fezz\Acube\Sdk\Italy\Invoice\Dto\InvoiceDto;

/**
 * Data Transfer Object representing a customer notification webhook payload.
 *
 * This DTO represents the webhook payload received when a notification event
 * is triggered for a sent invoice.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/notifications/
 */
final readonly class CustomerNotificationWebhookDto extends Dto
{
    /**
     * Create a new customer notification webhook DTO.
     *
     * @param  NotificationDto  $notification  The notification data
     * @param  InvoiceDto|array<string, mixed>  $invoice  The invoice data (DTO or array)
     */
    public function __construct(
        public NotificationDto $notification,
        public InvoiceDto|array $invoice
    ) {}

    /**
     * Create a customer notification webhook DTO from an array.
     *
     * @param  array<string, mixed>  $data  The webhook payload data
     */
    public static function from(array $data): static
    {
        /** @var array<string, mixed> $notificationData */
        $notificationData = $data['notification'] ?? [];
        $notification = NotificationDto::from($notificationData);

        /** @var array<string, mixed>|InvoiceDto $invoiceData */
        $invoiceData = $data['invoice'] ?? [];
        $invoice = is_array($invoiceData)
            ? InvoiceDto::from($invoiceData)
            : $invoiceData;

        return new self(
            notification: $notification,
            invoice: $invoice
        );
    }
}
