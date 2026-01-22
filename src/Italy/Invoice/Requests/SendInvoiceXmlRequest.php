<?php

declare(strict_types=1);

namespace Fezz\Acube\Sdk\Italy\Invoice\Requests;

use Fezz\Acube\Sdk\Italy\Invoice\Dto\SendInvoiceResponseDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasStringBody;

final class SendInvoiceXmlRequest extends Request implements HasBody
{
    use HasStringBody;

    protected Method $method = Method::POST;

    public function __construct(
        public readonly string $xml
    ) {}

    public function resolveEndpoint(): string
    {
        return '/invoices';
    }

    public function createDtoFromResponse(Response $response): SendInvoiceResponseDto
    {
        /** @var array<string, mixed> $json */
        $json = $response->json();

        return SendInvoiceResponseDto::from($json);
    }

    protected function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            // usa application/xml di default (text/xml solo se Acube lo richiede davvero)
            'Content-Type' => 'application/xml',
        ];
    }

    protected function defaultBody(): string
    {
        return $this->xml;
    }
}
