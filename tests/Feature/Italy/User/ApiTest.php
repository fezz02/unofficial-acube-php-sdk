<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\User\Api;
use Fezz\Acube\Sdk\Italy\User\Dto\GetAcceptOnlyVerifiedInvoicesRequestDto;
use Fezz\Acube\Sdk\Italy\User\Dto\GetRecipientCodeRequestDto;
use Fezz\Acube\Sdk\Italy\User\Dto\UpdateAcceptOnlyVerifiedInvoicesRequestDto;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function (): void {
});

test('get accept only verified invoices status', function (): void {
    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $api = new Api($connector);

    $mockClient = new MockClient([
        MockResponse::make([
            'accept_only_verified_invoices' => true,
        ], 200),
    ]);

    $connector->withMockClient($mockClient);

    $dto = new GetAcceptOnlyVerifiedInvoicesRequestDto('user-123');
    $response = $api->getAcceptOnlyVerifiedInvoices($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('update accept only verified invoices status', function (): void {
    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $api = new Api($connector);

    $mockClient = new MockClient([
        MockResponse::make([
            'accept_only_verified_invoices' => true,
        ], 200),
    ]);

    $connector->withMockClient($mockClient);

    $dto = new UpdateAcceptOnlyVerifiedInvoicesRequestDto('user-123', [
        'accept_only_verified_invoices' => true,
    ]);
    $response = $api->updateAcceptOnlyVerifiedInvoices($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});

test('get recipient code', function (): void {
    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $api = new Api($connector);

    $mockClient = new MockClient([
        MockResponse::make([
            'recipient_code' => 'ABCDEFG',
        ], 200),
    ]);

    $connector->withMockClient($mockClient);

    $dto = new GetRecipientCodeRequestDto('user-123');
    $response = $api->getRecipientCode($dto);

    expect($response)->toBeInstanceOf(Saloon\Http\Response::class)
        ->and($response->status())->toBe(200);
});
