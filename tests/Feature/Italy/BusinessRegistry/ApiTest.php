<?php

declare(strict_types=1);

use Fezz\Acube\Sdk\AcubeApi;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\BusinessRegistryConfigurationDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\BusinessRegistryDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\CreateBusinessRegistryConfigurationRequestDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\CreateBusinessRegistryRequestDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\GetBusinessRegistryConfigurationRequestDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\GetBusinessRegistryRequestDto;
use Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\GetBusinessRegistriesRequestDto;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('can list business registries', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->businessRegistry();

    $dto = new GetBusinessRegistriesRequestDto(simpleSearch: 'Test', page: 1);

    $mockData = [
        [
            'uuid' => '550e8400-e29b-41d4-a716-446655440000',
            'head_office_address_street' => 'Via Test',
            'head_office_address_zip_code' => '00100',
            'head_office_address_city' => 'Roma',
            'head_office_address_country' => 'IT',
            'business_name' => 'Test Company',
        ],
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->list($dto);

    expect($response->status())->toBe(200);
});

test('can create business registry', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->businessRegistry();

    $dto = new CreateBusinessRegistryRequestDto(
        head_office_address_street: 'Via Test',
        head_office_address_zip_code: '00100',
        head_office_address_city: 'Roma',
        head_office_address_country: 'IT',
        business_name: 'Test Company',
    );

    $mockData = [
        'uuid' => '550e8400-e29b-41d4-a716-446655440000',
        'head_office_address_street' => 'Via Test',
        'head_office_address_zip_code' => '00100',
        'head_office_address_city' => 'Roma',
        'head_office_address_country' => 'IT',
        'business_name' => 'Test Company',
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 201),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->create($dto);

    expect($response->status())->toBe(201);
});

test('can get business registry', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->businessRegistry();

    $mockData = [
        'uuid' => '550e8400-e29b-41d4-a716-446655440000',
        'head_office_address_street' => 'Via Test',
        'head_office_address_zip_code' => '00100',
        'head_office_address_city' => 'Roma',
        'head_office_address_country' => 'IT',
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->get('12345678901');

    expect($response->status())->toBe(200);
});

test('can get business registry configuration', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->businessRegistry();

    $mockData = [
        'fiscal_id' => '12345678901',
        'name' => 'Test Company',
        'email' => 'test@example.com',
        'supplier_invoice_enabled' => true,
        'receipts_enabled' => false,
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->getConfiguration('12345678901');

    expect($response->status())->toBe(200);
});

test('can create business registry configuration', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->businessRegistry();

    $dto = new CreateBusinessRegistryConfigurationRequestDto(
        fiscal_id: '12345678901',
        name: 'Test Company',
        email: 'test@example.com',
        supplier_invoice_enabled: true,
    );

    $mockData = [
        'fiscal_id' => '12345678901',
        'name' => 'Test Company',
        'email' => 'test@example.com',
        'supplier_invoice_enabled' => true,
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 201),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->createConfiguration($dto);

    expect($response->status())->toBe(201);
});

test('can update business registry', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->businessRegistry();

    $bodyDto = new \Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\UpdateBusinessRegistryRequestDto(
        head_office_address_street: 'Via Updated',
        head_office_address_zip_code: '00100',
        head_office_address_city: 'Roma',
        head_office_address_country: 'IT',
    );

    $mockData = [
        'uuid' => '550e8400-e29b-41d4-a716-446655440000',
        'head_office_address_street' => 'Via Updated',
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->update('12345678901', $bodyDto);

    expect($response->status())->toBe(200);
});

test('can delete business registry', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->businessRegistry();

    $mockClient = new MockClient([
        MockResponse::make('', 204),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->delete('12345678901');

    expect($response->status())->toBe(204);
});

test('can list business registry configurations', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->businessRegistry();

    $dto = new \Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\GetBusinessRegistryConfigurationsRequestDto(
        fiscal_id: '12345678901',
        page: 1
    );

    $mockData = [
        [
            'fiscal_id' => '12345678901',
            'name' => 'Test Company',
        ],
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->listConfigurations($dto);

    expect($response->status())->toBe(200);
});

test('can update business registry configuration', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->businessRegistry();

    $bodyDto = new \Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\UpdateBusinessRegistryConfigurationRequestDto(
        fiscal_id: '12345678901',
        name: 'Updated Company',
    );

    $mockData = [
        'fiscal_id' => '12345678901',
        'name' => 'Updated Company',
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->updateConfiguration('12345678901', $bodyDto);

    expect($response->status())->toBe(200);
});

test('can delete business registry configuration', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->businessRegistry();

    $mockClient = new MockClient([
        MockResponse::make('', 204),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->deleteConfiguration('12345678901');

    expect($response->status())->toBe(204);
});

test('can appoint fisconline', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->businessRegistry();

    $dto = new \Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\AppointFisconlineRequestDto(
        id: '12345678901',
        appointee_fiscal_id: 'A-CUBE',
        codice_fiscale: 'RSSMRA80A01H501U',
        password: 'password123',
        pin: '1234',
    );

    $mockClient = new MockClient([
        MockResponse::make('', 204),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->appointFisconline($dto);

    expect($response->status())->toBe(204);
});

test('can appoint spid', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->businessRegistry();

    $dto = new \Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\AppointSpidRequestDto(
        id: '12345678901',
        appointee_fiscal_id: 'A-CUBE',
        appointing_person_data_fiscal_code: 'RSSMRA80A01H501U',
        appointing_person_data_name: 'Mario',
        appointing_person_data_surname: 'Rossi',
        appointing_person_data_residence: 'Roma',
        appointing_person_data_otp_cell_phone: '+3912345678',
        appointing_person_data_email: 'mario.rossi@example.com',
    );

    $mockData = ['url' => 'https://example.com/appoint'];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 201),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->appointSpid($dto);

    expect($response->status())->toBe(201);
});

test('can get appoint status', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->businessRegistry();

    $mockData = [
        'receipt_enabled' => true,
        'status' => 'completed',
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->getAppointStatus('12345678901');

    expect($response->status())->toBe(200);
});

test('can set ade credentials', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->businessRegistry();

    $dto = new \Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\SetAdeCredentialsRequestDto(
        id: '12345678901',
        codice_fiscale: 'RSSMRA80A01H501U',
        password: 'password123',
        pin: '1234',
    );

    $mockClient = new MockClient([
        MockResponse::make('', 204),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->setAdeCredentials($dto);

    expect($response->status())->toBe(204);
});

test('can get receipt settings', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->businessRegistry();

    $mockData = [
        'phone_number' => '+3912345678',
        'receipts_alert_recipients' => ['alert@example.com'],
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->getReceiptSettings('12345678901');

    expect($response->status())->toBe(200);
});

test('can update receipt settings', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->businessRegistry();

    $dto = new \Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\UpdateReceiptSettingsRequestDto(
        phone_number: '+3912345678',
        receipts_alert_recipients: ['alert@example.com'],
    );

    $mockData = [
        'phone_number' => '+3912345678',
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->updateReceiptSettings('12345678901', $dto);

    expect($response->status())->toBe(200);
});

test('can get reporting', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->businessRegistry();

    $mockData = [
        'rejected_invoices_alert_schedule' => ['daily' => true],
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->getReporting('12345678901');

    expect($response->status())->toBe(200);
});

test('can update reporting', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->businessRegistry();

    $dto = new \Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\UpdateReportingRequestDto(
        rejected_invoices_alert_schedule: ['daily' => true, 'time' => '09:00'],
    );

    $mockData = [
        'rejected_invoices_alert_schedule' => ['daily' => true],
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->updateReporting('12345678901', $dto);

    expect($response->status())->toBe(200);
});

test('can reset legal storage password', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->businessRegistry();

    $mockClient = new MockClient([
        MockResponse::make('', 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->resetLegalStoragePassword('12345678901');

    expect($response->status())->toBe(200);
});

test('can list sub accounts', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->businessRegistry();

    $mockData = [
        ['email' => 'sub1@example.com'],
        ['email' => 'sub2@example.com'],
    ];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 200),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->listSubAccounts('12345678901');

    expect($response->status())->toBe(200);
});

test('can add sub account', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->businessRegistry();

    $dto = new \Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\AddSubAccountRequestDto(
        id: '12345678901',
        email: 'subaccount@example.com',
    );

    $mockData = ['email' => 'subaccount@example.com'];

    $mockClient = new MockClient([
        MockResponse::make($mockData, 201),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->addSubAccount($dto);

    expect($response->status())->toBe(201);
});

test('can remove sub account', function (): void {
    $connector = AcubeApi::italy();
    $api = $connector->businessRegistry();

    $dto = new \Fezz\Acube\Sdk\Italy\BusinessRegistry\Dto\RemoveSubAccountRequestDto(
        id: '12345678901',
        email: 'subaccount@example.com'
    );

    $mockClient = new MockClient([
        MockResponse::make('', 204),
    ]);

    $connector->withMockClient($mockClient);

    $response = $api->removeSubAccount($dto);

    expect($response->status())->toBe(204);
});

