<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\User;

use Fezz\Acube\Sdk\BaseResource;
use Fezz\Acube\Sdk\Italy\User\Dto\UpdateAcceptOnlyVerifiedInvoicesRequestDto;
use Fezz\Acube\Sdk\Italy\User\Requests\GetAcceptOnlyVerifiedInvoicesRequest;
use Fezz\Acube\Sdk\Italy\User\Requests\GetRecipientCodeRequest;
use Fezz\Acube\Sdk\Italy\User\Requests\UpdateAcceptOnlyVerifiedInvoicesRequest;
use Saloon\Http\Response;

/**
 * User API resource for the A-Cube Italy API.
 *
 * Provides methods for managing user settings.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/users/
 */
final class Api extends BaseResource
{
    /**
     * Get verified invoices status.
     *
     * Retrieves verified supplier invoices status.
     *
     * Endpoint: GET /users/{id}/accept-only-verified-invoices
     *
     * @param  Dto\GetAcceptOnlyVerifiedInvoicesRequestDto  $dto  The request data including user ID
     * @return Response The HTTP response containing the verified invoices status
     */
    public function getAcceptOnlyVerifiedInvoices(Dto\GetAcceptOnlyVerifiedInvoicesRequestDto $dto): Response
    {
        return $this->connector->send(new GetAcceptOnlyVerifiedInvoicesRequest($dto));
    }

    /**
     * Update verified invoices status.
     *
     * Updates the verified supplier invoices status.
     *
     * Endpoint: PUT /users/{id}/accept-only-verified-invoices
     *
     * @param  UpdateAcceptOnlyVerifiedInvoicesRequestDto  $dto  The request data including ID and user data
     * @return Response The HTTP response containing the updated status
     */
    public function updateAcceptOnlyVerifiedInvoices(UpdateAcceptOnlyVerifiedInvoicesRequestDto $dto): Response
    {
        return $this->connector->send(new UpdateAcceptOnlyVerifiedInvoicesRequest($dto));
    }

    /**
     * Get recipient code.
     *
     * Retrieves the 7-character recipient code.
     *
     * Endpoint: GET /users/{id}/recipient-code
     *
     * @param  Dto\GetRecipientCodeRequestDto  $dto  The request data including user ID
     * @return Response The HTTP response containing the recipient code
     */
    public function getRecipientCode(Dto\GetRecipientCodeRequestDto $dto): Response
    {
        return $this->connector->send(new GetRecipientCodeRequest($dto));
    }
}
