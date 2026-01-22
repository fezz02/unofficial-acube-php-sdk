<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Notification\Dto;

use Fezz\Acube\Sdk\Concerns\NotificationType;
use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object representing a notification.
 *
 * This DTO represents a notification received from SDI regarding an invoice,
 * containing information about the notification type, file, message, etc.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/notifications/
 */
final readonly class NotificationDto extends Dto
{
    /**
     * Create a new notification DTO.
     *
     * @param  string  $uuid  The unique identifier for the notification
     * @param  string  $invoice_uuid  The UUID of the associated invoice
     * @param  string  $created_at  ISO 8601 timestamp when the notification was created
     * @param  NotificationType  $type  The notification type code
     * @param  string|null  $file_name  The name of the notification file
     * @param  string|null  $message  The notification message (JSON string)
     * @param  bool  $downloaded  Whether the notification has been downloaded
     * @param  string|null  $downloaded_at  ISO 8601 timestamp when the notification was downloaded
     */
    public function __construct(
        public string $uuid,
        public string $invoice_uuid,
        public string $created_at,
        public NotificationType $type,
        public ?string $file_name,
        public ?string $message,
        public bool $downloaded,
        public ?string $downloaded_at,
    ) {}

    /**
     * Create a notification DTO from an array.
     * Handles the type conversion from string to enum.
     *
     * @param  array<string, mixed>  $data  The notification data
     */
    public static function from(array $data): static
    {
        $type = is_string($data['type'] ?? null)
            ? NotificationType::from($data['type'])
            : NotificationType::NOTIFICA_SCARTO;

        /** @var string $uuid */
        $uuid = $data['uuid'] ?? '';
        /** @var string $invoiceUuid */
        $invoiceUuid = $data['invoice_uuid'] ?? '';
        /** @var string $createdAt */
        $createdAt = $data['created_at'] ?? '';
        /** @var string|null $fileName */
        $fileName = $data['file_name'] ?? null;
        /** @var string|null $message */
        $message = $data['message'] ?? null;
        /** @var bool $downloaded */
        $downloaded = $data['downloaded'] ?? false;
        /** @var string|null $downloadedAt */
        $downloadedAt = $data['downloaded_at'] ?? null;

        return new self(
            uuid: $uuid,
            invoice_uuid: $invoiceUuid,
            created_at: $createdAt,
            type: $type,
            file_name: $fileName,
            message: $message,
            downloaded: $downloaded,
            downloaded_at: $downloadedAt,
        );
    }
}
