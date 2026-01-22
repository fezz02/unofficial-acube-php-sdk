<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\AppointSpidRequestDto;
use Fezz\Acube\Sdk\Concerns\Endpoint;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Requests\AppointSpidRequest;
use Fezz\Acube\Sdk\Italy\ItalyConnector;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('resolveEndpoint returns correct path', function (): void {
    $dto = new AppointSpidRequestDto(
        id: '12345678901',
        appointee_fiscal_id: 'A-CUBE',
        appointing_person_data_fiscal_code: 'RSSMRA80A01H501U',
        appointing_person_data_name: 'Mario',
        appointing_person_data_surname: 'Rossi',
        appointing_person_data_residence: 'Roma',
        appointing_person_data_otp_cell_phone: '+3912345678',
        appointing_person_data_email: 'mario.rossi@example.com',
    );
    $request = new AppointSpidRequest($dto);

    expect($request->resolveEndpoint())->toBe('/business-registry-configurations/12345678901/appoint/spid');
});

test('createDtoFromResponse returns array', function (): void {
    $dto = new AppointSpidRequestDto(
        id: '12345678901',
        appointee_fiscal_id: 'A-CUBE',
        appointing_person_data_fiscal_code: 'RSSMRA80A01H501U',
        appointing_person_data_name: 'Mario',
        appointing_person_data_surname: 'Rossi',
        appointing_person_data_residence: 'Roma',
        appointing_person_data_otp_cell_phone: '+3912345678',
        appointing_person_data_email: 'mario.rossi@example.com',
    );
    $request = new AppointSpidRequest($dto);

    $connector = new ItalyConnector(Endpoint::ITALY_SANDBOX);
    $mockClient = new MockClient([
        MockResponse::make(['url' => 'https://example.com/appoint'], 201),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send($request);
    $result = $request->createDtoFromResponse($response);

    expect($result)->toBeArray()
        ->and($result['url'])->toBe('https://example.com/appoint');
});

test('defaultBody returns correct body', function (): void {
    $dto = new AppointSpidRequestDto(
        id: '12345678901',
        appointee_fiscal_id: 'A-CUBE',
        appointing_person_data_fiscal_code: 'RSSMRA80A01H501U',
        appointing_person_data_name: 'Mario',
        appointing_person_data_surname: 'Rossi',
        appointing_person_data_residence: 'Roma',
        appointing_person_data_otp_cell_phone: '+3912345678',
        appointing_person_data_email: 'mario.rossi@example.com',
        return_url: 'https://example.com/return',
    );
    $request = new AppointSpidRequest($dto);

    $reflection = new ReflectionClass($request);
    $method = $reflection->getMethod('defaultBody');
    $body = $method->invoke($request);

    expect($body)->toBeArray()
        ->and($body['appointee_fiscal_id'])->toBe('A-CUBE')
        ->and($body['appointing_person_data']['name'])->toBe('Mario')
        ->and($body['return_url'])->toBe('https://example.com/return');
});

