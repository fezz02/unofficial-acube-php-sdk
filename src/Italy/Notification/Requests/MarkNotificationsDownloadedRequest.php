<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Notification\Requests;

use Fezz\Acube\Sdk\Italy\Notification\Dto\MarkNotificationsDownloadedRequestDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Request for marking notifications as downloaded.
 *
 * This request sends a POST request to set the downloaded flag for a collection of notifications.
 *
 * Endpoint: POST /notifications/downloaded
 * Base URL: https://api.acubeapi.com (production) or https://api-sandbox.acubeapi.com (sandbox)
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/notifications/
 */
final class MarkNotificationsDownloadedRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * Create a new mark notifications downloaded request.
     *
     * @param  MarkNotificationsDownloadedRequestDto  $data  The request data including notification UUIDs
     */
    public function __construct(
        public readonly MarkNotificationsDownloadedRequestDto $data
    ) {}

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The endpoint path
     */
    public function resolveEndpoint(): string
    {
        return '/notifications/downloaded';
    }

    /**
     * Create a DTO from the response.
     *
     * @param  Response  $response  The HTTP response
     * @return array<string, mixed> The response data
     */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return $json;
    }

    /**
     * Get the default body for the request.
     *
     * @return array<string, mixed> The request body containing the notification UUIDs
     */
    protected function defaultBody(): array
    {
        return [
            'uuids' => $this->data->uuids,
        ];
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
            'Content-Type' => 'application/json',
        ];
    }
}
