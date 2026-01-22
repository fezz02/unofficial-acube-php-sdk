<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Webhooks\SupplierInvoice\Payload;

use Fezz\Acube\Sdk\Dto;
use Fezz\Acube\Sdk\Italy\Invoice\Dto\FatturaElettronicaBodyDto;
use Fezz\Acube\Sdk\Italy\Invoice\Dto\FatturaElettronicaHeaderDto;

/**
 * Data Transfer Object representing the invoice payload in a supplier invoice webhook.
 *
 * This DTO represents the complete FatturaPA invoice structure as received in webhook payloads.
 */
final readonly class InvoicePayloadDto extends Dto
{
    /**
     * Create a new invoice payload DTO.
     *
     * @param  FatturaElettronicaHeaderDto  $fattura_elettronica_header  The invoice header
     * @param  FatturaElettronicaBodyDto  $fattura_elettronica_body  The invoice body
     */
    public function __construct(
        public FatturaElettronicaHeaderDto $fattura_elettronica_header,
        public FatturaElettronicaBodyDto $fattura_elettronica_body,
    ) {}

    /**
     * Create an invoice payload DTO from an array.
     *
     * @param  array<string, mixed>  $data  The payload data
     */
    public static function from(array $data): static
    {
        $headerData = $data['fattura_elettronica_header'] ?? [];
        $headerData = is_array($headerData) ? $headerData : [];
        /** @var array<string, mixed> $headerData */

        // Filter header data to only include fields that FatturaElettronicaHeaderDto accepts
        $datiTrasmissione = $headerData['dati_trasmissione'] ?? [];
        $cedentePrestatore = $headerData['cedente_prestatore'] ?? [];
        $cessionarioCommittente = $headerData['cessionario_committente'] ?? [];

        $datiTrasmissioneArray = is_array($datiTrasmissione) ? $datiTrasmissione : [];
        $cedentePrestatoreArray = is_array($cedentePrestatore) ? $cedentePrestatore : [];
        $cessionarioCommittenteArray = is_array($cessionarioCommittente) ? $cessionarioCommittente : [];

        /** @var array<string, mixed> $datiTrasmissioneArray */
        /** @var array<string, mixed> $cedentePrestatoreArray */
        /** @var array<string, mixed> $cessionarioCommittenteArray */
        $header = $headerData !== []
            ? new FatturaElettronicaHeaderDto(
                dati_trasmissione: $datiTrasmissioneArray,
                cedente_prestatore: $cedentePrestatoreArray,
                cessionario_committente: $cessionarioCommittenteArray,
            )
            : new FatturaElettronicaHeaderDto(
                dati_trasmissione: [],
                cedente_prestatore: [],
                cessionario_committente: [],
            );

        $bodyData = $data['fattura_elettronica_body'] ?? [];
        $bodyData = is_array($bodyData) ? $bodyData : [];

        // If bodyData is an array of arrays, take the first element
        $bodyItem = [];
        if ($bodyData !== []) {
            // If it's a list array, take the first element
            if (array_is_list($bodyData) && isset($bodyData[0]) && is_array($bodyData[0])) {
                $firstItem = $bodyData[0];
                /** @var array<string, mixed> $firstItem */
                $bodyItem = $firstItem;
            } elseif (! array_is_list($bodyData)) {
                // If it's already an associative array (single body), use it directly
                $bodyItem = $bodyData;
            }
        }
        /** @var array<string, mixed> $bodyItem */

        // Filter body data to only include fields that FatturaElettronicaBodyDto accepts
        $datiGenerali = $bodyItem['dati_generali'] ?? [];
        $datiBeniServizi = $bodyItem['dati_beni_servizi'] ?? [];

        $datiGeneraliArray = is_array($datiGenerali) ? $datiGenerali : [];
        $datiBeniServiziArray = is_array($datiBeniServizi) ? $datiBeniServizi : [];

        /** @var array<string, mixed> $datiGeneraliArray */

        // Ensure dati_beni_servizi is properly typed as array<int, array<string, mixed>>
        $datiBeniServiziTyped = [];
        foreach ($datiBeniServiziArray as $item) {
            if (is_array($item)) {
                /** @var array<string, mixed> $item */
                $datiBeniServiziTyped[] = $item;
            }
        }

        $body = new FatturaElettronicaBodyDto(
            dati_generali: $datiGeneraliArray,
            dati_beni_servizi: $datiBeniServiziTyped,
        );

        return new self(
            fattura_elettronica_header: $header,
            fattura_elettronica_body: $body,
        );
    }
}
