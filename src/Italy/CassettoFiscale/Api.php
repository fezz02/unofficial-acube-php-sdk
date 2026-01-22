<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\CassettoFiscale;

use Fezz\Acube\Sdk\BaseResource;
use Fezz\Acube\Sdk\Italy\CassettoFiscale\Dto\CreateInvoiceDownloadJobRequestDto;
use Fezz\Acube\Sdk\Italy\CassettoFiscale\Dto\ScheduleInvoiceDownloadRequestDto;
use Fezz\Acube\Sdk\Italy\CassettoFiscale\Dto\UpdateScheduledInvoiceDownloadRequestDto;
use Fezz\Acube\Sdk\Italy\CassettoFiscale\Requests\CreateInvoiceDownloadJobRequest;
use Fezz\Acube\Sdk\Italy\CassettoFiscale\Requests\DeleteScheduledInvoiceDownloadRequest;
use Fezz\Acube\Sdk\Italy\CassettoFiscale\Requests\GetScheduledInvoiceDownloadRequest;
use Fezz\Acube\Sdk\Italy\CassettoFiscale\Requests\ScheduleInvoiceDownloadRequest;
use Fezz\Acube\Sdk\Italy\CassettoFiscale\Requests\UpdateScheduledInvoiceDownloadRequest;
use Saloon\Http\Response;

/**
 * Cassetto Fiscale API resource for the A-Cube Italy API.
 *
 * Provides methods for scheduling and managing invoice downloads from the
 * "Cassetto Fiscale" (Italian tax authority's digital mailbox).
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/cassettofiscale/
 */
final class Api extends BaseResource
{
    /**
     * Schedule invoice downloads.
     *
     * Schedules daily invoice downloads at 03:00 UTC from the last 3 days
     * or full archive.
     *
     * Endpoint: POST /schedule/invoice-download/{fiscal_id}
     *
     * @param  string  $fiscalId  The fiscal ID
     * @param  ScheduleInvoiceDownloadRequestDto  $dto  The schedule configuration
     * @return Response The HTTP response containing the schedule information
     */
    public function schedule(string $fiscalId, ScheduleInvoiceDownloadRequestDto $dto): Response
    {
        return $this->connector->send(new ScheduleInvoiceDownloadRequest($fiscalId, $dto));
    }

    /**
     * Get scheduled invoice download information.
     *
     * Retrieves the current schedule configuration for a fiscal ID.
     *
     * Endpoint: GET /schedule/invoice-download/{fiscal_id}
     *
     * @param  string  $fiscalId  The fiscal ID
     * @return Response The HTTP response containing the schedule information
     */
    public function getSchedule(string $fiscalId): Response
    {
        return $this->connector->send(new GetScheduledInvoiceDownloadRequest($fiscalId));
    }

    /**
     * Delete a scheduled invoice download.
     *
     * Removes a scheduled invoice download configuration.
     *
     * Endpoint: DELETE /schedule/invoice-download/{fiscal_id}
     *
     * @param  string  $fiscalId  The fiscal ID
     * @return Response The HTTP response (204 on success)
     */
    public function deleteSchedule(string $fiscalId): Response
    {
        return $this->connector->send(new DeleteScheduledInvoiceDownloadRequest($fiscalId));
    }

    /**
     * Update scheduled invoice download auto-renewal.
     *
     * Updates the auto-renewal setting for a scheduled invoice download.
     *
     * Endpoint: PUT /schedule/invoice-download/{fiscal_id}
     *
     * @param  string  $fiscalId  The fiscal ID
     * @param  UpdateScheduledInvoiceDownloadRequestDto  $dto  The update payload
     * @return Response The HTTP response containing the updated schedule information
     */
    public function updateSchedule(string $fiscalId, UpdateScheduledInvoiceDownloadRequestDto $dto): Response
    {
        return $this->connector->send(new UpdateScheduledInvoiceDownloadRequest($fiscalId, $dto));
    }

    /**
     * Create a one-shot invoice download job.
     *
     * Creates a one-time invoice download job for a specific date range.
     *
     * Endpoint: POST /jobs/invoice-download
     *
     * @param  CreateInvoiceDownloadJobRequestDto  $dto  The job data
     * @return Response The HTTP response containing the job UUID
     */
    public function createJob(CreateInvoiceDownloadJobRequestDto $dto): Response
    {
        return $this->connector->send(new CreateInvoiceDownloadJobRequest($dto));
    }
}
