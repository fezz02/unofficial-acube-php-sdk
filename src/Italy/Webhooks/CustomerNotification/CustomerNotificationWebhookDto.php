<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Webhooks\CustomerNotification;

use Fezz\Acube\Sdk\Dto;
use Fezz\Acube\Sdk\Italy\Webhooks\CustomerNotification\Notification\CustomerNotificationDto;
use Fezz\Acube\Sdk\Italy\Webhooks\CustomerNotification\Notification\InvoiceDto;

/**
 * Data Transfer Object representing a customer notification webhook payload.
 *
 * This DTO represents the complete webhook payload received when a customer notification
 * event is triggered. It contains the notification data and optionally the full invoice
 * object if provided in the webhook payload.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/notifications/
 */
final readonly class CustomerNotificationWebhookDto extends Dto
{
    /**
     * Create a new customer notification webhook DTO.
     *
     * The webhook payload has the notification data at the root level, not nested under 'notification'.
     *
     * @param  CustomerNotificationDto  $notification  The notification data
     * @param  InvoiceDto|null  $invoice  Optional invoice data (if provided in webhook)
     */
    public function __construct(
        public CustomerNotificationDto $notification,
        public ?InvoiceDto $invoice = null,
    ) {}

    /**
     * Create a customer notification webhook DTO from an array.
     *
     * @param  array<string, mixed>  $data  The webhook payload data
     */
    public static function from(array $data): static
    {
        // The webhook payload has notification data at root level, not nested
        $notificationData = $data['notification'] ?? [];
        if (is_array($notificationData)) {
            /** @var array<string, mixed> $notificationData */
            $notification = CustomerNotificationDto::from($notificationData);
        } else {
            $notification = CustomerNotificationDto::from([]);
        }

        $invoiceData = $data['invoice'] ?? null;
        if (isset($invoiceData) && is_array($invoiceData) && $invoiceData !== []) {
            /** @var array<string, mixed> $invoiceData */
            $invoice = InvoiceDto::from($invoiceData);
        } else {
            $invoice = null;
        }

        return new self(
            notification: $notification,
            invoice: $invoice,
        );
    }
}
