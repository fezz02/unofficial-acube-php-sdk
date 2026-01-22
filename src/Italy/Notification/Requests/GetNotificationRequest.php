<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Notification\Requests;

use Fezz\Acube\Sdk\Italy\Notification\Dto\GetNotificationRequestDto;
use Fezz\Acube\Sdk\Italy\Notification\Dto\NotificationDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Request for retrieving a single notification by UUID.
 *
 * This request sends a GET request to retrieve a specific notification by its UUID.
 *
 * Endpoint: GET /notifications/{uuid}
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/notifications/
 */
final class GetNotificationRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Create a new get notification request.
     *
     * @param  GetNotificationRequestDto  $dto  The request data including notification UUID
     */
    public function __construct(
        public readonly GetNotificationRequestDto $dto,
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return "/notifications/{$this->dto->uuid}";
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return NotificationDto|string The response DTO containing the notification data or XML string
     */
    public function createDtoFromResponse(Response $response): NotificationDto|string
    {
        $contentType = $response->header('Content-Type');
        $contentTypeString = '';
        if (is_string($contentType)) {
            $contentTypeString = $contentType;
        } elseif (is_array($contentType) && isset($contentType[0]) && is_string($contentType[0])) {
            $contentTypeString = $contentType[0];
        }

        if ($contentTypeString !== '' && str_contains($contentTypeString, 'application/json')) {
            /** @var array<string, mixed> $json */
            $json = $response->json();

            return NotificationDto::from($json);
        }

        return $response->body();
    }

    /**
     * Get the default headers for the request.
     *
     * @return array<string, string> The default headers
     */
    protected function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
        ];
    }
}
