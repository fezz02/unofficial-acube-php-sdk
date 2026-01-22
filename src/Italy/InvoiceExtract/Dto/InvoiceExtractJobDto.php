<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\InvoiceExtract\Dto;

use Fezz\Acube\Sdk\Concerns\InvoiceExtractJobStatus;
use Fezz\Acube\Sdk\Dto;

/**
 * Data Transfer Object representing an invoice extract job.
 *
 * This DTO represents a job that extracts invoice information from a PDF
 * and converts it to FatturaPA XML/JSON format.
 *
 * @see https://docs.acubeapi.com/documentation/gov-it/invoice-extract/
 */
final readonly class InvoiceExtractJobDto extends Dto
{
    /**
     * Create a new invoice extract job DTO.
     *
     * @param  string  $uuid  The unique identifier for the job
     * @param  string  $acquisition_date  ISO 8601 timestamp when the job was created
     * @param  string  $filename  The name of the uploaded PDF file
     * @param  InvoiceExtractJobStatus  $job_status  The current status of the job
     * @param  int|null  $pages  The number of pages in the PDF (null if not yet processed)
     */
    public function __construct(
        public string $uuid,
        public string $acquisition_date,
        public string $filename,
        public InvoiceExtractJobStatus $job_status,
        public ?int $pages = null
    ) {}

    /**
     * Create an invoice extract job DTO from an array.
     * Handles the job_status conversion from string to enum.
     *
     * @param  array<string, mixed>  $data  The job data
     */
    public static function from(array $data): static
    {
        $jobStatus = is_string($data['job_status'] ?? null)
            ? InvoiceExtractJobStatus::from($data['job_status'])
            : InvoiceExtractJobStatus::WAITING;

        /** @var string $uuid */
        $uuid = $data['uuid'] ?? '';
        /** @var string $acquisitionDate */
        $acquisitionDate = $data['acquisition_date'] ?? '';
        /** @var string $filename */
        $filename = $data['filename'] ?? '';
        /** @var int|null $pages */
        $pages = isset($data['pages']) && is_numeric($data['pages']) ? (int) $data['pages'] : null;

        return new self(
            uuid: $uuid,
            acquisition_date: $acquisitionDate,
            filename: $filename,
            job_status: $jobStatus,
            pages: $pages
        );
    }
}
