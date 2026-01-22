<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Webhooks\CustomerNotification\Notification;

use Fezz\Acube\Sdk\Concerns\NotificationType;
use Fezz\Acube\Sdk\Dto;
use ValueError;

/**
 * Data Transfer Object representing the notification data within a customer notification webhook.
 *
 * This DTO represents the notification-level data (uuid, invoice_uuid, type, etc.)
 * that wraps the message content.
 */
final readonly class CustomerNotificationDto extends Dto
{
    /**
     * Create a new customer notification notification DTO.
     *
     * @param  string  $uuid  The unique identifier for the notification
     * @param  string  $invoice_uuid  The UUID of the associated invoice
     * @param  string  $created_at  ISO 8601 timestamp when the notification was created
     * @param  NotificationType  $type  The notification type code
     * @param  string|null  $file_name  The name of the notification file
     * @param  CustomerNotificationMessageDto  $message  The message content
     * @param  bool  $downloaded  Whether the notification has been downloaded
     */
    public function __construct(
        public string $uuid,
        public string $invoice_uuid,
        public string $created_at,
        public NotificationType $type,
        public ?string $file_name,
        public CustomerNotificationMessageDto $message,
        public bool $downloaded,
    ) {}

    /**
     * Create a customer notification DTO from an array.
     *
     * @param  array<string, mixed>  $data  The notification data
     */
    public static function from(array $data): static
    {
        $typeValue = $data['type'] ?? '';
        try {
            $type = (is_string($typeValue) && $typeValue !== '') || is_int($typeValue)
                ? NotificationType::from($typeValue)
                : NotificationType::NOTIFICA_SCARTO;
        } catch (ValueError) {
            $type = NotificationType::NOTIFICA_SCARTO;
        }

        // Ensure message is an array, not null or empty
        $messageData = $data['message'] ?? [];
        if (! is_array($messageData)) {
            $messageData = [];
        }
        /** @var array<string, mixed> $messageData */
        $message = CustomerNotificationMessageDto::from($messageData);

        return new self(
            uuid: is_string($data['uuid'] ?? null) ? $data['uuid'] : '',
            invoice_uuid: is_string($data['invoice_uuid'] ?? null) ? $data['invoice_uuid'] : '',
            created_at: is_string($data['created_at'] ?? null) ? $data['created_at'] : '',
            type: $type,
            file_name: isset($data['file_name']) && is_string($data['file_name']) ? $data['file_name'] : null,
            message: $message,
            downloaded: is_bool($data['downloaded'] ?? null) && $data['downloaded'],
        );
    }
}
